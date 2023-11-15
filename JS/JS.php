<?php

namespace SEVEN_TECH\Portfolio\JS;

use SEVEN_TECH\Portfolio\Pages\Pages;
use SEVEN_TECH\Portfolio\Post_Types\Post_Types;
use SEVEN_TECH\Portfolio\Taxonomies\Taxonomies;

class JS
{
    private $handle_prefix;
    private $dir;
    private $dirURL;
    private $buildDir;
    private $buildDirURL;
    private $buildFilePrefix;
    private $buildFilePrefixURL;
    private $front_page_react;
    private $page_titles;
    private $post_types_list;
    private $includes_url;
    private $taxonomies;

    public function __construct()
    {
        $this->handle_prefix = 'seven_tech_portfolio_';
        $this->dir = SEVEN_TECH_PORTFOLIO;
        $this->dirURL = SEVEN_TECH_PORTFOLIO_URL;

        $this->buildDir = $this->dir . 'build/';
        $this->buildDirURL = $this->dirURL . 'build/';
        $this->buildFilePrefix = $this->buildDir . 'src_views_';
        $this->buildFilePrefixURL = $this->buildDirURL . 'src_views_';

        $pages = new Pages;
        $posttypes = new Post_Types;
        $tax = new Taxonomies;

        $this->page_titles = [
            ...$pages->pages_list,
            ...$pages->protected_pages_list
        ];
        $this->front_page_react = $pages->front_page_react;
        $this->post_types_list = $posttypes->post_types_list;

        $this->includes_url = includes_url();
        $this->taxonomies = $tax->taxonomies_list;
    }

    function load_js()
    {
        // Animations
        wp_register_script($this->handle_prefix, SEVEN_TECH_PORTFOLIO_URL . 'JS/seven-tech.js', array('jquery'), false, false);
        wp_enqueue_script($this->handle_prefix);
    }

    function load_front_page_react()
    {
        if ($_SERVER['REQUEST_URI'] === '/') {
            if (is_array($this->front_page_react) && !empty($this->front_page_react)) {
                foreach ($this->front_page_react as $section) {
                    $fileName = ucwords($section);
                    $filePath = $this->buildFilePrefix . $fileName . '_jsx.js';
                    $filePathURL = $this->buildFilePrefixURL . $fileName . '_jsx.js';

                    wp_enqueue_script('wp-element', $this->includes_url . 'js/dist/element.min.js', [], null, true);

                    if (file_exists($filePath)) {
                        wp_enqueue_script($this->handle_prefix . 'react_' . $fileName, $filePathURL, ['wp-element'], 1.0, true);
                    } else {
                        error_log($fileName . ' page has not been created in react JSX.');
                    }

                    wp_enqueue_script($this->handle_prefix . 'react_index', $this->buildDirURL . 'index.js', ['wp-element'], '1.0', true);
                }
            } else {
                error_log('There are no front page react files to load at ' . $this->dir . ' Pages');
            }
        }
    }

    function load_pages_react()
    {
        if (!empty($this->page_titles) && is_array($this->page_titles)) {
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

                    $fileName = str_replace(' ', '', ucwords(str_replace('/', ' ', $page)));

                    $filePath = $this->buildFilePrefix . $fileName . '_jsx.js';
                    $filePathURL = $this->buildFilePrefixURL . $fileName . '_jsx.js';

                    wp_enqueue_script('wp-element', $this->includes_url . 'js/dist/element.min.js', [], null, true);

                    if (file_exists($filePath)) {
                        wp_enqueue_script($this->handle_prefix . 'react_' . $fileName, $filePathURL, ['wp-element'], 1.0, true);
                    } else {
                        error_log($page . ' page has not been created in react JSX.');
                    }

                    wp_enqueue_script($this->handle_prefix . 'react_index', $this->buildDirURL . 'index.js', ['wp-element'], '1.0', true);
                }
            }
        } else {
            error_log('There are no page titles in the array at ' . $this->dir . ' Pages');
        }
    }

    function load_post_types_archive_react()
    {
        foreach ($this->post_types_list as $post_type_name => $post_type_class) {
            if (is_array($this->post_types_list)) {
                $fileName = ucwords($post_type_name);
                $filePath = $this->buildFilePrefix . $fileName . '_jsx.js';
                $filePathURL = $this->buildFilePrefixURL . $fileName . '_jsx.js';

                wp_enqueue_script('wp-element', $this->includes_url . 'js/dist/element.min.js', [], null, true);

                if (file_exists($filePath)) {
                    wp_enqueue_script($this->handle_prefix . 'react_' . $fileName, $filePathURL, ['wp-element'], 1.0, true);
                } else {
                    error_log('Post Type ' . ucfirst($post_type_name) . ' page has not been created in react JSX.');
                }

                wp_enqueue_script($this->handle_prefix . 'react_index', $this->buildDirURL . 'index.js', ['wp-element'], '1.0', true);
            } else {
                error_log('There are no post types in the array at ' . $this->dir . ' Post_Types');
            }
        }
    }

    function load_post_types_single_react()
    {
        foreach ($this->post_types_list as $post_type_name => $post_name_class) {
            if (is_array($this->post_types_list)) {
                if (is_singular($post_type_name)) {
                    $fileName = ucwords($post_type_name);
                    $filePath = $this->buildFilePrefix . $fileName . '_jsx.js';
                    $filePathURL = $this->buildFilePrefixURL . $fileName . '_jsx.js';

                    wp_enqueue_script('wp-element', $this->includes_url . 'js/dist/element.min.js', [], null, true);

                    if (file_exists($filePath)) {
                        wp_enqueue_script($this->handle_prefix . 'react_' . $fileName, $filePathURL, ['wp-element'], 1.0, true);
                    } else {
                        error_log('Post Type ' . ucfirst($post_type_name) . ' page has not been created in react JSX.');
                    }

                    wp_enqueue_script($this->handle_prefix . 'react_index', $this->buildDirURL . 'index.js', ['wp-element'], '1.0', true);
                }
            }
        }
    }
}
