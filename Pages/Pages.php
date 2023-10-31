<?php

namespace SEVEN_TECH_Portfolio\Pages;

class Pages
{
    public $front_page_react;
    public $page_titles;

    public function __construct()
    {
        $this->front_page_react = [
            'portfolio',
        ];

        $this->page_titles = [
            'project/onboarding',
            'project/problem',
        ];

        add_action('init', [$this, 'project_react_rewrite_rules']);

        add_filter('query_vars', [$this, 'add_query_var_project']);
    }

    function project_react_rewrite_rules()
    {
        if (is_array($this->page_titles) && count($this->page_titles) > 0) {

            foreach ($this->page_titles as $page_title) {
                $url = explode('/', $page_title);

                add_rewrite_rule('^' . $page_title, 'index.php?' . $url[1] . '=$1', 'top');
            }
        }
    }

    function add_query_var_project($query_vars)
    {
        if (is_array($this->page_titles) && count($this->page_titles) > 0) {

            foreach ($this->page_titles as $page_title) {
                $url = explode('/', $page_title);
                
                $query_vars[] = $url[1];
            }

            return $query_vars;
        }
    }

    function is_user_logged_in()
    {
        return isset($_SESSION['idToken']);
    }
}
