<?php

namespace SEVEN_TECH\Portfolio\Taxonomies;

use SEVEN_TECH\Portfolio\Taxonomies\Taxonomies;

use SEVEN_TECH\Portfolio\Model\Portfolio\Skill;
use SEVEN_TECH\Portfolio\Model\Image;
use SEVEN_TECH\Portfolio\Model\Term;

use Exception;
use WP_Term;

class Skills
{
    public $taxonomies;

    public function __construct()
    {
        $this->taxonomies = new Taxonomies;
    }

    function createSkill(Term $term)
    {
        try {
            $args = array(
                'description' => $term->description,
                'slug' => $term->path
            );

            $result = wp_insert_term($term->title, $term->type, $args);

            if (is_wp_error($result)) {
                $errorMessage = $result->get_error_message();
                throw new Exception($errorMessage, 400);
            }

            if (isset($term->image) && $term->image instanceof Image) {
                update_term_meta($result['term_id'], 'url', $term->image->url);
                update_term_meta($result['term_id'], 'class_name', $term->image->className);
            }

            if (isset($term->usage)) {
                update_term_meta($result['term_id'], 'usage', $term->usage);
            }

            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    function getSkill(WP_Term $term)
    {
        try {
            $id = $term->term_id;

            $url = get_term_meta($id, 'url', true);
            $className = get_term_meta($id, 'class_name', true);
            $usage = get_term_meta($id, 'usage', true);

            $image = null;

            if ($url || $className) {
                $image = new Image();
                $image->setID($id);
                $image->setTitle($term->name);
                $image->setDescription($term->description);

                if ($url) {
                    $image->setURL($url);
                }

                if ($className) {
                    $image->setClassName($className);
                }
            }

            $skillTerm = new Skill($id, $term->taxonomy);
            $skillTerm->setTitle($term->name);
            $skillTerm->setDescription($term->description);
            $skillTerm->setPath($term->slug);

            if ($image) {
                $skillTerm->setImage($image);
            }

            $skillTerm->setUsage($usage);

            return $skillTerm;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    function getSkillTerm(string $taxonomy, string $slug)
    {
        try {
            $term = get_term_by('slug', $slug, $taxonomy);

            if ($term == false) {
                return '';
            }

            return $this->getSkill($term);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    function getSkillTerms(string $taxonomy)
    {
        try {
            $skillTerms = [];

            $terms = get_terms([
                'taxonomy' => $taxonomy,
                'hide_empty' => false,
            ]);

            if (is_wp_error($terms)) {
                $errorMessage = $terms->get_error_message();
                throw new Exception($errorMessage, 400);
            }

            foreach ($terms as $term) {
                $skillTerms[] = $this->getSkill($term);
            }

            return $skillTerms;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    function getAll()
    {
        try {
            $taxonomies = [];

            foreach ($this->taxonomies->taxonomies_list as $taxonomy) {
                $taxonomies[] = $this->getSkillTerms($taxonomy->name);
            }

            return $taxonomies;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    function updateSkill(string $taxonomy, string $slug, Term $term)
    {
        try {
            $updatedTerm = $this->taxonomies->updateTerm($taxonomy, $slug, $term);

            if (isset($term->image) && $term->image instanceof Image) {
                update_term_meta($updatedTerm['term_id'], 'url', $term->image->url);
                update_term_meta($updatedTerm['term_id'], 'class_name', $term->image->className);
            }

            if (isset($term->usage)) {
                update_term_meta($updatedTerm['term_id'], 'usage', $term->usage);
            }

            return $this->taxonomies->updateTerm($taxonomy, $slug, $term);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    function deleteSkill(string $taxonomy, string $slug)
    {
        try {
            $term = get_term_by('slug', $slug, $taxonomy);

            if ($term == false) {
                return '';
            }

            delete_term_meta($term->id, 'url');
            delete_term_meta($term->id, 'class_name');

            return $this->taxonomies->deleteTerm($taxonomy, $slug);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
