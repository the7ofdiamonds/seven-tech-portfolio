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

    public function getPortfolioProject($id, $title, $description, $url)
    {
        try {
            $project_database = $this->project_database->getProject($id);
            $technologies = $this->taxonomies->getTaxTermLinks($id, 'project_tags');
            $solution_gallery = $this->media->urls("portfolio/{$id}/solution-gallery", 'image/');

            $portfolio = [
                'id' => $id,
                'title' => $title,
                'description' => $description,
                'project_status' => isset($project_database['project_status']) ? $project_database['project_status'] : '',
                'technologies' => $technologies,
                'solution_gallery' => !empty($solution_gallery) ? $solution_gallery : '',
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
                $portfolio[] = $this->getPortfolioProject($project->ID, $project->post_title, $project->post_excerpt, "/{$project->post_type}/{$project->post_name}");
            }

            return $portfolio;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
