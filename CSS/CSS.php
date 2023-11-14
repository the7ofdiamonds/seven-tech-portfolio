<?php

namespace SEVEN_TECH\Portfolio\CSS;

use SEVEN_TECH\Portfolio\Pages\Pages;
use SEVEN_TECH\Portfolio\Post_Types\Post_Types;
use SEVEN_TECH\Portfolio\Taxonomies\Taxonomies;

use SEVEN_TECH\Portfolio\CSS\Customizer\Customizer;

class CSS
{
    private $handle_prefix;
    private $cssFolderPath;
    private $cssFolderPathURL;
    private $cssFileName;
    private $filePath;
    private $page_titles;
    private $post_types_list;
    private $taxonomies_list;

    public function __construct()
    {
        $this->handle_prefix = 'seven_tech_portfolio_';
        $this->cssFolderPath = SEVEN_TECH_PORTFOLIO . 'CSS/';
        $this->cssFolderPathURL = SEVEN_TECH_PORTFOLIO_URL . 'CSS/';
        $this->cssFileName = 'seven-tech-portfolio.css';

        $this->filePath = $this->cssFolderPath . $this->cssFileName;

        $pages = new Pages;
        $posttypes = new Post_Types;
        $tax = new Taxonomies;

        $this->page_titles = [
            ...$pages->pages_list,
            ...$pages->protected_pages_list
        ];
        $this->post_types_list = $posttypes->post_types_list;
        $this->taxonomies_list = $tax->taxonomies_list;

        // new Customizer;
    }

    function load_front_page_css()
    {
        if ($_SERVER['REQUEST_URI'] === '/') {
            if ($this->filePath) {
                wp_register_style($this->handle_prefix . 'css',  $this->cssFolderPathURL . $this->cssFileName, array(), false, 'all');
                wp_enqueue_style($this->handle_prefix . 'css');
            } else {
                error_log('CSS file is missing at :' . $this->filePath);
            }
        }
    }

    function load_pages_css()
    {
        foreach ($this->page_titles as $page) {
            $full_url = explode('/', $page);
            $full_path = explode('/', $_SERVER['REQUEST_URI']);

            $full_url = array_filter($full_url, function ($value) {
                return $value !== "";
            });

            $full_path = array_filter($full_path, function ($value) {
                return $value !== "";
            });

            $full_url = array_values($full_url);
            $full_path = array_values($full_path);

            $differences = array_diff($full_url, $full_path);

            if (empty($differences)) {
                if ($this->filePath) {
                    wp_register_style($this->handle_prefix . 'css',  $this->cssFolderPathURL . $this->cssFileName, array(), false, 'all');
                    wp_enqueue_style($this->handle_prefix . 'css');
                } else {
                    error_log('CSS file is missing at :' . $this->filePath);
                }
            }
        }
    }

    function load_post_types_css()
    {
        foreach ($this->post_types_list as $post_type) {
            if (is_post_type_archive($post_type) || is_singular($post_type)) {
                if ($this->filePath) {
                    wp_register_style($this->handle_prefix . 'css',  $this->cssFolderPathURL . $this->cssFileName, array(), false, 'all');
                    wp_enqueue_style($this->handle_prefix . 'css');
                } else {
                    error_log('CSS file is missing at :' . $this->filePath);
                }
            }
        }
    }

    function load_taxonomies_css()
    {
        foreach ($this->taxonomies_list as $taxonomy) {
            if (is_tax($taxonomy['taxonomy'])) {
                if ($this->filePath) {
                    wp_register_style($this->handle_prefix . 'css',  $this->cssFolderPathURL . $this->cssFileName, array(), false, 'all');
                    wp_enqueue_style($this->handle_prefix . 'css');
                } else {
                    error_log('CSS file is missing at :' . $this->filePath);
                }
            }
        }
    }
}
