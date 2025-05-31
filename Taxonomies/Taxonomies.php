<?php

namespace SEVEN_TECH\Portfolio\Taxonomies;

use SEVEN_TECH\Portfolio\Model\WPTaxonomy;
use SEVEN_TECH\Portfolio\Model\Term;

use SEVEN_TECH\Portfolio\Media\Media;

use Exception;

use  WP_Query;

class Taxonomies
{
    public $taxonomies_list;
    private $media;

    public function __construct()
    {
        $post_types = [
            'portfolio',
            'employees',
            'executives',
            'founders',
            'freelancers',
            'investors',
            'managing_members',
        ];

        $this->taxonomies_list = [
            new WPTaxonomy(
                'Project Types',
                'Project Type',
                'Project Types',
                'project-types',
                3,
                $post_types
            ),
            new WPTaxonomy(
                'Languages',
                'Language',
                'Languages',
                'languages',
                4,
                $post_types
            ),
            new WPTaxonomy(
                'Frameworks',
                'Framework',
                'Frameworks',
                'frameworks',
                5,
                $post_types
            ),
            new WPTaxonomy(
                'Technologies',
                'Technology',
                'Technologies',
                'technologies',
                6,
                $post_types
            ),
            new WPTaxonomy(
                'Services',
                'Service',
                'Services',
                'services',
                7,
                $post_types
            ),
        ];

        $this->media = new Media;
    }

    function customTaxonomy()
    {
        if (is_array($this->taxonomies_list)) {
            foreach ($this->taxonomies_list as $taxonomy) {
                register_taxonomy($taxonomy->name, $taxonomy->post_types, $taxonomy->getArgs());
            }
        }
    }

    function getTaxonomyPostTypes($taxonomy)
    {
        try {
            if (is_array($this->taxonomies_list)) {
                $postTypes = [];

                foreach ($this->taxonomies_list as $item) {
                    if ($item['name'] === $taxonomy) {
                        $postTypes = $item['post_types'];
                        break;
                    }
                }

                return $postTypes;
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at getTaxonomyPostTypes');
            return $response;
        }
    }

    function getTaxonomyNames()
    {
        try {
            $taxonomyNames = [];

            foreach ($this->taxonomies_list as $taxonomy) {
                $taxonomyNames[] = $taxonomy->name;
            };

            return $taxonomyNames;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at getTaxonomyNames');
            return $response;
        }
    }

    function addTerm(Term $term)
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

            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    function getTaxonomy($term_id, $name, $description)
    {
        $faIcon = get_term_meta($term_id, 'fa_icon', true);
        $iconURL = get_term_meta($term_id, 'icon_url', true);

        $term_link = get_term_link($term_id);

        $taxonomy = [
            'id' => $term_id,
            'title' => $name,
            'icon' => [
                'name' => $name,
                'description' => $description,
                'fa_icon' => $faIcon,
                'icon_url' => $this->media->getURL('icons', $iconURL)
            ],
            'url' => $term_link
        ];

        return $taxonomy;
    }

    function getPostTypeTaxonomies($post_type, $taxonomy)
    {
        try {
            if (empty($post_type)) {
                throw new Exception('Post ID is required.', 400);
            }

            if (empty($taxonomy)) {
                throw new Exception('Taxonomy is required.', 400);
            }

            $taxonomy_data = get_object_taxonomies($post_type, 'objects');

            $taxonomies = [];

            foreach ($taxonomy_data as $tax) {
                $terms = get_terms([
                    'taxonomy'   => $tax->name,
                    'hide_empty' => false,
                ]);

                if ($tax->name === $taxonomy) {
                    foreach ($terms as $term) {
                        $taxonomies[] = $this->getTaxonomy($term->term_id, $term->name, $term->description);
                    }
                }
            }

            return $taxonomies;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at getPostTypeTaxonomies');
            return $response;
        }
    }

    function getPostTaxonomy($post_id, $taxonomy)
    {
        try {
            if (empty($post_id)) {
                throw new Exception('Post ID is required to get Taxonomy.', 400);
            }

            $terms = get_the_terms($post_id, $taxonomy);

            if (!is_array($terms) || $terms == false || is_wp_error($terms)) {
                return '';
            }

            $taxonomy = [];

            foreach ($terms as $term) {
                $taxonomy[] = $this->getTaxonomy($term->term_id, $term->name, $term->description);
            }

            return $taxonomy;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at getPostTaxonomies');
            return $response;
        }
    }

    function getTaxonomyTerm(string $taxonomy, string $slug)
    {
        try {
            $term = get_term_by('slug', $slug, $taxonomy);

            if ($term == false) {
                return '';
            }

            $taxTerm = $this->getTaxonomy($term->term_id, $term->name, $term->description);

            return $taxTerm;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at getTaxonomyTerm');
            return $response;
        }
    }

    function getTaxonomyTerms(string $taxonomy)
    {
        try {
            $terms = get_terms([
                'taxonomy' => $taxonomy,
                'hide_empty' => false,
            ]);

            if (is_wp_error($terms)) {
                $errorMessage = $terms->get_error_message();
                throw new Exception($errorMessage, 400);
            }

            return $terms;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at getTaxonomyTerm');
            return $response;
        }
    }

    function getTaxonomies()
    {
        try {
            $taxonomies = [];

            foreach ($this->taxonomies_list as $taxonomy) {
                $taxonomies[] = $this->getTaxonomyTerms($taxonomy->name);
            }

            return $taxonomies;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at getTaxonomyTerm');
            return $response;
        }
    }

    function updateTerm(string $taxonomy, string $slug, Term $term)
    {
        try {
            $queriedTerm = get_term_by('slug', $slug, $taxonomy);

            $args = array(
                'name'        => $term->title,
                'description' => $term->description,
                'slug' => $term->path
            );

            $result = wp_update_term($queriedTerm->term_id, $taxonomy, $args);

            if (is_wp_error($result)) {
                $errorMessage = $result->get_error_message();
                throw new Exception($errorMessage, 400);
            }

            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    function deleteTerm(string $taxonomy, string $slug)
    {
        try {
            $queriedTerm = get_term_by('slug', $slug, $taxonomy);

            $result = wp_delete_term($queriedTerm->term_id, $taxonomy);

            if (is_wp_error($result)) {
                $errorMessage = $result->get_error_message();
                throw new Exception($errorMessage, 400);
            }

            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    function getTaxonomyTermByUser($nicename, $taxonomy, $term)
    {
        try {
            $user = get_user_by('slug', $nicename);

            if (empty($user)) {
                throw new Exception('User could not be found.', 404);
            }

            $args = array(
                'taxonomy'      => $taxonomy,
                'term' => $term,
                'author'         => $user->ID,
                'posts_per_page' => -1,
            );

            $query = new WP_Query($args);

            $post_types = $query->posts;

            if (empty($post_types)) {
                return '';
            }

            return $post_types;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function getPostTypeTaxonomiesByUser($nicename, $postTypes, $taxonomy)
    {
        try {
            $user = get_user_by('slug', $nicename);

            if (empty($user)) {
                throw new Exception('User could not be found.', 404);
            }

            $args = array(
                'taxonomy' => $taxonomy,
                'post_type'      => $postTypes,
                'author'         => $user->ID,
                'posts_per_page' => -1,
            );

            $query = new WP_Query($args);

            $post_types = $query->posts;

            if (empty($post_types)) {
                return '';
            }

            return $post_types;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
