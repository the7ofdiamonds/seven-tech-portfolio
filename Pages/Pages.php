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
            'portfolio',
        ];

        $this->protected_pages_list = [
            ['url' => 'project/onboarding'],
            ['url' => 'project/problem/([a-zA-Z+-]+)'],
        ];

        $this->pages_list = [];

        $this->page_titles = [
            ...$this->protected_pages_list,
            ...$this->pages_list
        ];
    }

    function react_rewrite_rules()
    {
        if (is_array($this->page_titles) && count($this->page_titles) > 0) {

            foreach ($this->page_titles as $page_title) {
                $url = explode('/', $page_title['url']);
                $segment = count($url) - 1;

                if (isset($url[$segment])) {
                    add_rewrite_rule('^' . $page_title['url'], 'index.php?' . $url[$segment] . '=$1', 'top');
                }
            }
        }
    }

    function add_query_vars($query_vars)
    {
        if (is_array($this->page_titles) && count($this->page_titles) > 0) {

            foreach ($this->page_titles as $page_title) {
                $url = explode('/', $page_title['url']);
                $segment = count($url) - 1;

                $query_vars[] = $url[$segment];
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
