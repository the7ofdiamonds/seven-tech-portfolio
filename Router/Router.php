<?php

namespace SEVEN_TECH\Portfolio\Router;

use SEVEN_TECH\Portfolio\Pages\Pages;
use SEVEN_TECH\Portfolio\Post_Types\Post_Types;
use SEVEN_TECH\Portfolio\Templates\Templates;

class Router
{
    private $pages;
    private $post_types;
    private $templates;
    private $protected_pages_list;
    private $pages_list;
    private $post_types_list;

    public function __construct()
    {
        $this->pages = new Pages;
        $this->post_types = new Post_Types;
        $this->templates = new Templates;

        $this->protected_pages_list = $this->pages->protected_pages_list;
        $this->pages_list = $this->pages->pages_list;
        $this->post_types_list = $this->post_types->post_types_list;
    }

    function load_page()
    {
        $path = $_SERVER['REQUEST_URI'];

        if ($path === '/') {
            add_filter('frontpage_template', [$this->templates, 'get_front_page_template']);
        }

        if (!empty($this->protected_pages_list)) {
            foreach ($this->protected_pages_list as $pattern) {
                $regex = '#^/' . $pattern . '/$#';

                if (preg_match($regex, $path)) {
                    add_filter('template_include', [$this->templates, 'get_protected_page_template']);
                    break;
                }
            }
        }

        if (!empty($this->pages_list) && $path !== '/') {
            foreach ($this->pages_list as $pattern) {
                $regex = '#^/' . $pattern . '/$#';

                if (preg_match($regex, $path)) {
                    add_filter('template_include', [$this->templates, 'get_page_template']);
                    break;
                }
            }
        }

        if (!empty($this->post_types_list) && $path !== '/') {
            foreach ($this->post_types_list as $post_type_name => $post_type_class) {
                $url = array_filter(explode('/', $path), function ($value) {
                    return !empty($value);
                });

                if ($url[1] === $post_type_name) {
                    if (count($url) === 1) {
                        add_filter('archive_template', [$this->templates, 'get_archive_page_template']);
                        break;
                    }

                    add_filter('single_template', [$this->templates, 'get_single_page_template']);
                    break;
                }
            }
        }
    }
}
