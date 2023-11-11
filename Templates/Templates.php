<?php

namespace SEVEN_TECH_Portfolio\Templates;

use SEVEN_TECH_Portfolio\CSS\CSS;
use SEVEN_TECH_Portfolio\JS\JS;
use SEVEN_TECH_Portfolio\Pages\Pages;
use SEVEN_TECH_Portfolio\Post_Types\Post_Types;
use SEVEN_TECH_Portfolio\Taxonomies\Taxonomies;

class Templates
{
    private $protected_pages;
    private $pages;
    private $post_types;
    private $taxonomies;
    private $css_file;
    private $js_file;

    public function __construct()
    {
        $pages = new Pages;
        $posttypes = new Post_Types();
        $taxonomies = new Taxonomies;
        $this->css_file = new CSS;
        $this->js_file = new JS;

        $this->protected_pages = $pages->protected_pages;
        $this->pages = $pages->pages;
        $this->post_types = $posttypes->post_types;
        $this->taxonomies = $taxonomies->taxonomies;

        $this->load_page();
    }

    function load_page()
    {
        if ($_SERVER['REQUEST_URI'] === '/') {
            add_filter('frontpage_template', [$this, 'get_custom_front_page']);
        }

        if (!empty($this->protected_pages)) {
            foreach ($this->protected_pages as $page) {
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
                    add_filter('template_include', [$this, 'get_custom_protected_page_template']);
                }
            }
        }

        if (!empty($this->pages)) {
            foreach ($this->pages as $page) {
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
                    add_filter('template_include', [$this, 'get_custom_page_template']);
                }
            }
        }

        if (!empty($this->post_types)) {
            add_filter('archive_template', [$this, 'get_archive_template']);
            add_filter('single_template', [$this, 'get_single_template']);
            }

        if(!empty($this->taxonomies)){
            add_filter('taxonomy_template', [$this, 'get_taxonomy_template']);
        }
    }

    function get_custom_front_page($frontpage_template)
    {
        if ($_SERVER['REQUEST_URI'] === '/') {
            add_action('wp_head', [$this->css_file, 'load_front_page_css']);
            add_action('wp_footer', [$this->js_file, 'load_front_page_react']);
        }

        return $frontpage_template;
    }

    function get_custom_protected_page_template($page_template)
    {
        $page_template = SEVEN_TECH_PORTFOLIO . 'Pages/page-protected.php';

        if (file_exists($page_template)) {
            add_action('wp_head', [$this->css_file, 'load_pages_css']);
            add_action('wp_footer', [$this->js_file, 'load_pages_react']);

            return $page_template;
        } else {
            error_log('Protected Page Template does not exist.');
        }

        return $page_template;
    }

    function get_custom_page_template($page_template)
    {
        $page_template = SEVEN_TECH_PORTFOLIO . 'Pages/page.php';

        if (file_exists($page_template)) {
            add_action('wp_head', [$this->css_file, 'load_pages_css']);
            add_action('wp_footer', [$this->js_file, 'load_pages_react']);

            return $page_template;
        } else {
            error_log('Page Template does not exist.');
        }

        return $page_template;
    }

    function get_archive_template($archive_template)
    {
        foreach ($this->post_types as $post_type) {

            if (is_post_type_archive($post_type['name'])) {
                $archive_template = SEVEN_TECH_PORTFOLIO . 'Post_Types/' . $post_type['plural'] . '/archive-' . $post_type['name'] . '.php';

                if (file_exists($archive_template)) {
                    add_action('wp_head', [$this->css_file, 'load_post_types_css']);
                    add_action('wp_footer', [$this->js_file, 'load_post_types_archive_react']);

                    return $archive_template;
                }
            }
        }

        return $archive_template;
    }

    function get_single_template($singular_template)
    {
            foreach ($this->post_types as $post_type) {

                if (is_singular($post_type['name'])) {
                    $singular_template = SEVEN_TECH_PORTFOLIO . 'Post_Types/' . $post_type['plural'] . '/single-' . $post_type['name'] . '.php';

                    if (file_exists($singular_template)) {
                        add_action('wp_head', [$this->css_file, 'load_post_types_css']);
                        add_action('wp_footer', [$this->js_file, 'load_post_types_single_react']);

                        return $singular_template;
                    }
                }
            }

        return $singular_template;
    }

    function get_taxonomy_template($taxonomy_template)
    {
        if (is_array($this->taxonomies) && count($this->taxonomies) > 0) {
            foreach ($this->taxonomies as $taxonomy) {

                if (is_tax($taxonomy['taxonomy'])) {
                    $taxonomy_template = SEVEN_TECH_PORTFOLIO . 'Pages/page.php';

                    if (file_exists($taxonomy_template)) {
                        add_action('wp_head', [$this->css_file, 'load_taxonomies_css']);
                        add_action('wp_footer', [$this->js_file, 'load_taxonomies_react']);

                        return $taxonomy_template;
                    }
                }
            }
        }

        return $taxonomy_template;
    }
}
