<?php

namespace SEVEN_TECH\Portfolio\Pages;

class Pages
{
    public $front_page_react;
    public $pages_list;
    public $protected_pages_list;
    public $page_titles;

    public function __construct()
    {
        $this->front_page_react = [
            'Portfolio',
        ];

        $this->protected_pages_list = [
            [
                'regex' => '#^/project/onboarding/[^/]+#',
                'file_name' => 'ProjectOnboarding'
            ],
            [
                'regex' => '#^/project/problem/[^/]+#',
                'file_name' => 'ProjectProblem'
            ],
        ];        

        $this->pages_list = [];

        $this->page_titles = [
            ...$this->protected_pages_list,
            ...$this->pages_list
        ];
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

    function react_rewrite_rules()
    {
        if (is_array($this->page_titles) && count($this->page_titles) > 0) {
            foreach ($this->page_titles as $page_title) {
                $lastSegment = $this->get_last_url_segment($page_title['regex']);

                add_rewrite_rule($page_title['regex'], 'index.php?' . $lastSegment . '=$matches[1]', 'top');
                break;
            }
        }
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

    function is_user_logged_in()
    {
        return isset($_SESSION['idToken']);
    }
}
