<?php

namespace SEVEN_TECH_Portfolio\Templates;

use SEVEN_TECH_Portfolio\CSS\CSS;
use SEVEN_TECH_Portfolio\JS\JS;
use SEVEN_TECH_Portfolio\Pages\Pages;
use SEVEN_TECH_Portfolio\Post_Types\Post_Types;
use SEVEN_TECH_Portfolio\Taxonomies\Taxonomies;

class Templates
{
    private $page_titles;
    private $post_types;
    private $taxonomies;
    private $css_file;
    private $js_file;

    public function __construct()
    {
        add_filter('frontpage_template', [$this, 'get_custom_front_page']);

        add_filter('template_include', [$this, 'get_custom_page_template']);
        add_filter('template_include', [$this, 'get_custom_protected_page_template']);

        add_filter('archive_template', [$this, 'get_archive_template']);
        add_filter('single_template', [$this, 'get_single_template']);

        add_filter('taxonomy_template', [$this, 'get_taxonomy_template']);

        $pages = new Pages;
        $posttypes = new Post_Types();
        $taxonomies = new Taxonomies;

        $this->page_titles = $pages->page_titles;
        $this->post_types = $posttypes->post_types;
        $this->taxonomies = $taxonomies->taxonomies;

        $this->css_file = new CSS;
        $this->js_file = new JS;
    }

    function get_custom_front_page($frontpage_template)
    {
        if (is_front_page()) {
            add_action('wp_head', [$this->css_file, 'load_front_page_css']);
            add_action('wp_footer', [$this->js_file, 'load_front_page_react']);
        }

        return $frontpage_template;
    }

    function get_custom_protected_page_template($page_template)
    {
        if (is_array($this->page_titles) && count($this->page_titles) > 0) {
            foreach ($this->page_titles as $page_title) {
                $request_uri = $_SERVER['REQUEST_URI'];
                $page = explode('/', $page_title);
                $request = explode('/', $request_uri);

                if ($page[1] === $request[1] && $page[2] === $request[2] || $page_title === $request_uri) {
                    $page_template = SEVEN_TECH_PORTFOLIO . 'Pages/page-protected.php';

                    if (file_exists($page_template)) {
                        add_action('wp_head', [$this->css_file, 'load_pages_css']);
                        add_action('wp_footer', [$this->js_file, 'load_pages_react']);

                        return $page_template;
                    } else {
                        error_log('Protected Page Template does not exist.');
                    }
                }
            }
        }

        return $page_template;
    }

    function get_custom_page_template($page_template)
    {
        if (is_array($this->page_titles) && count($this->page_titles) > 0) {
            foreach ($this->page_titles as $page_title) {
                $request_uri = $_SERVER['REQUEST_URI'];
                $page = explode('/', $page_title);
                $request = explode('/', $request_uri);

                if ($page[1] === $request[1] && $page[2] === $request[2] || $page_title === $request_uri) {
                    $page_template = SEVEN_TECH_PORTFOLIO . 'Pages/page.php';

                    if (file_exists($page_template)) {
                        add_action('wp_head', [$this->css_file, 'load_pages_css']);
                        add_action('wp_footer', [$this->js_file, 'load_pages_react']);

                        return $page_template;
                    } else {
                        error_log('Page Template does not exist.');
                    }
                }
            }
        }

        return $page_template;
    }

    function get_archive_template($archive_template)
    {
        if (is_array($this->post_types) && count($this->post_types) > 0) {
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
        }
        return $archive_template;
    }

    function get_single_template($singular_template)
    {
        if (is_array($this->post_types) && count($this->post_types) > 0) {
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
