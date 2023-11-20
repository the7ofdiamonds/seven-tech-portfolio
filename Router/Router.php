<?php

namespace SEVEN_TECH\Portfolio\Router;

use Exception;

use SEVEN_TECH\Portfolio\Pages\Pages;
use SEVEN_TECH\Portfolio\Templates\Templates;

class Router
{
    private $templates;
    private $protected_pages_list;
    private $pages_list;
    private $page_titles;

    public function __construct()
    {
        $pages = new Pages;
        $this->templates = new Templates;

        $this->protected_pages_list = $pages->protected_pages_list;
        $this->pages_list = $pages->pages_list;
        $this->page_titles = $pages->page_titles;
    }

    function load_page()
    {
        try {
            $path = $_SERVER['REQUEST_URI'];

            if ($path === '/') {
                add_filter('frontpage_template', [$this->templates, 'get_front_page_template']);
                return;
            }

            if (!empty($this->protected_pages_list)) {
                foreach ($this->protected_pages_list as $protected_page) {

                    if (preg_match($protected_page['regex'], $path)) {
                        add_filter('template_include', [$this->templates, 'get_protected_page_template']);
                        break;
                    }
                }
            }

            if (!empty($this->pages_list) && $path !== '/') {
                foreach ($this->pages_list as $page) {

                    if (preg_match($page['regex'], $path)) {
                        add_filter('template_include', [$this->templates, 'get_page_template']);
                        break;
                    }
                }
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at load_page');

            return $response;
        }
    }

    function get_last_url_segment($regex)
    {
        $regex = preg_replace("/\([^)]+\)/", "", $regex);
        $path = preg_replace("#[^a-zA-Z/]+#", "", $regex);
        $url = explode('/', $path);
        $url = array_filter($url, function ($value) {
            return !empty($value);
        });
        $lastSegment = end($url);

        return $lastSegment;
    }

    function get_last_url_index($url)
    {
        $url_array = explode('/', $url);

        return count($url_array);
    }

    function react_rewrite_rules()
    {
        add_rewrite_rule('^project/onboarding/([a-zA-Z0-9-_]+)/?', 'index.php?', 'top');
        add_rewrite_rule('^project/problem/([a-zA-Z0-9-_]+)/?', 'index.php?', 'top');
    }

    function add_query_vars($query_vars)
    {
        if (is_array($this->page_titles) && count($this->page_titles) > 0) {
            foreach ($this->page_titles as $page_title) {
                $lastSegment = $this->get_last_url_segment($page_title['regex']);

                $query_vars[] = $lastSegment;
            }

            return $query_vars;
        }

        return $query_vars;
    }
}
