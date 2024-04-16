<?php

namespace SEVEN_TECH\Portfolio\Post_Types\Portfolio;

use Exception;

use WP_Query;

use SEVEN_TECH\Portfolio\Media\Media;
use SEVEN_TECH\Portfolio\Database\Database;
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
        $database = new Database;

        $this->project_database = new DatabaseProject($database->project_table);
        $this->taxonomies = new Taxonomies;
    }

    public function getPortfolio()
    {
        try {
            $args = array(
                'post_type' => $this->post_type,
                'posts_per_page' => 10,
            );
            $query = new WP_Query($args);

            if (!$query->have_posts()) {
                return '';
            }

            $post_data = $query->posts;

            $portfolio = [];

            foreach ($post_data as $project) {
                $id = $project->ID;
                $project_database = $this->project_database->getProject($id);
                $solution_gallery = $this->media->urls("portfolio/{$id}/solution-gallery", 'image/');

                $portfolio[] = array(
                    'id' => $id,
                    'title' => $project->post_title,
                    'solution_gallery' => !empty($solution_gallery) ? $solution_gallery : '',
                    'project_status' => isset($project_database['project_status']) ? $project_database['project_status'] : '',
                    'technologies' => [['name' => 'java', 'icon' => 'java'], ['name' => 'javascript', 'icon' => 'js']],
                    'url' => "/{$project->post_type}/{$project->post_name}",
                );
            }

            return $portfolio;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function getPortfolioTypes()
    {
        try {
            $project_types = $this->taxonomies->get_post_type_taxonomy($this->post_type, 'project_types');

            return $project_types;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function getPortfolioTags()
    {
        try {
            $project_tags = $this->taxonomies->get_post_type_taxonomy($this->post_type, 'project_tags');

            return $project_tags;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
