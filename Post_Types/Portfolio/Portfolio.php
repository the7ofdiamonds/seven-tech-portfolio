<?php

namespace SEVEN_TECH\Portfolio\Post_Types\Portfolio;

use Exception;

use WP_Query;

use SEVEN_TECH\Portfolio\Media\Media;
use SEVEN_TECH\Portfolio\Database\DatabaseProject;
use SEVEN_TECH\Portfolio\Taxonomies\Taxonomies;

class Portfolio
{
    private $post_type;
    private $media;
    private $project_database;
    private $taxonomies;

    public function __construct()
    {
        $this->post_type = 'portfolio';
        $this->media = new Media;

        $this->project_database = new DatabaseProject();
        $this->taxonomies = new Taxonomies;
    }

    public function getPortfolioProject($id, $postType = '', $created = '', $updated = '', $title ='', $description = '', $url = '')
    {
        try {
            if (empty($id)) {
                throw new Exception('Post ID is required at getProduct');
            }

            if (empty($postType) || empty($created) || empty($updated) || empty($title) || empty($content) || empty($description) || empty($url)) {
                $post = get_post($id);

                if (empty($post)) {
                    return '';
                }

                $id = $post->ID;
                $postType = $post->post_type;
                $created = $post->post_date;
                $updated = $post->post_modified;
                $title = $post->post_title;
                $description = $post->post_excerpt;
                $url = "/{$postType}/{$post->post_name}";
            }

            $project_database = $this->project_database->getProject($id);
            $technologies = $this->taxonomies->getTaxTermLinks($id, 'project_tags');
            $solution_gallery = $this->media->urls("portfolio/{$id}/solution-gallery", 'image/');

            $project = [
                'id' => $id,
                'created' => $created,
                'updated' => $updated,
                'title' => $title,
                'description' => $description,
                'price' => !empty($project_database['price']) ? $project_database['price'] : '',
                'features' => !empty($database['features']) ? $database['features'] : '',
                'icon' => isset($project_database['project_status']) ? $project_database['project_status'] : '',
                'button_icon' => isset($project_database['button_icon']) ? $project_database['button_icon'] : 'fa-solid fa-cart-shopping',
                'action_word' => !empty($database['action_word']) ? $database['action_word'] : '',
                'project_status' => isset($project_database['project_status']) ? $project_database['project_status'] : '',
                'technologies' => $technologies,
                'gallery' => !empty($solution_gallery) ? $solution_gallery : '',
                'url' => $url,
            ];

            return $project;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function getPortfolio()
    {
        try {
            $args = array(
                'post_type' => $this->post_type,
                'posts_per_page' => -1,
            );
            $query = new WP_Query($args);

            if (!$query->have_posts()) {
                return '';
            }

            $post_data = $query->posts;

            $portfolio = [];

            foreach ($post_data as $project) {
                $id = $project->ID;
                $postType = $project->post_type;
                $created = $project->post_date;
                $updated = $project->post_modified;
                $title = $project->post_title;
                $description = $project->post_excerpt;
                $url = "/{$project->post_type}/{$project->post_name}";

                $portfolio[] = $this->getPortfolioProject($id, $postType, $created, $updated, $title, $description, $url);
            }

            return $portfolio;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
