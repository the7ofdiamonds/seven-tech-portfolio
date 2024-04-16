<?php

namespace SEVEN_TECH\Portfolio\Post_Types\Portfolio;

use Exception;

use WP_Query;

use SEVEN_TECH\Portfolio\Media\Media;
use SEVEN_TECH\Portfolio\Database\Database;
use SEVEN_TECH\Portfolio\Database\DatabaseProject;

class Portfolio
{
    private $post_type;
    private $media;
    private $project_database;

    public function __construct()
    {
        $this->post_type = 'portfolio';
        $this->media = new Media;
        $database = new Database;

        $this->project_database = new DatabaseProject($database->project_table);
    }

    public function getPortfolioProject($id, $title, $url)
    {
        try {
            $project_database = $this->project_database->getProject($id);
            $solution_gallery = $this->media->urls("portfolio/{$id}/solution-gallery", 'image/');

            $portfolio = [
                'id' => $id,
                'title' => $title,
                'solution_gallery' => !empty($solution_gallery) ? $solution_gallery : '',
                'project_status' => isset($project_database['project_status']) ? $project_database['project_status'] : '',
                'technologies' => [['name' => 'java', 'icon' => 'java'], ['name' => 'javascript', 'icon' => 'js']],
                'url' => $url,
            ];

            return $portfolio;
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
                $portfolio[] = $this->getPortfolioProject($project->ID, $project->post_title, "/{$project->post_type}/{$project->post_name}");
            }

            return $portfolio;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
