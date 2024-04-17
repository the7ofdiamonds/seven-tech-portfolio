<?php

namespace SEVEN_TECH\Portfolio\Taxonomies;

use Exception;

use WP_Query;

use SEVEN_TECH\Portfolio\Post_Types\Portfolio\Portfolio;

class TaxonomiesProjectTags
{
    public $taxonomies;
    public $portfolio;

    public function __construct()
    {
        $this->taxonomies = new Taxonomies;
        $this->portfolio = new Portfolio;
    }

    public function getProjectTags($post_type)
    {
        try {
            $project_tags = $this->taxonomies->get_post_type_taxonomy($post_type, 'project_tags');

            $projectTags = [];

            foreach ($project_tags as $projectTag) {
                $projectTags[] = [
                    'name' => $projectTag->name,
                    'icon' => $projectTag->slug,
                    'url' => "/project/tag/{$projectTag->slug}"
                ];
            }

            return $projectTags;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function getProjectTag($tag)
    {
        try {
            $taxonomy = 'project_tags';
            $args = array(
                'post_type' => array('post', 'portfolio'),
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field' => 'slug',
                        'terms' => $tag,
                    )
                )
            );

            $query = new WP_Query($args);

            $posts = $query->posts;

            if (empty($posts)) {
                throw new Exception('No portfolio items found', 404);
            }

            $projects = [];

            foreach ($posts as $post) {
                $projects[] = $this->portfolio->getPortfolioProject($post->ID, $post->post_title, $post->post_excerpt, "/{$post->post_type}/{$post->post_name}");
            }

            $term = get_term_by('slug', $tag, $taxonomy);

            $icon = '';
            $title = '';

            if (is_object($term)) {
                $icon = $term->slug;
                $title = $term->name;
            }

            $projectTags = [
                'icon' => $icon,
                'title' => $title,
                'projects' => $projects
            ];

            return rest_ensure_response($projectTags);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
