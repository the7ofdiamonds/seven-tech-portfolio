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
                'url' => '^project/onboarding/?',
                'regex' => '#^/project/onboarding+#',
                'file_name' => 'ProjectOnboarding'
            ],
            [
                'url' => '^project/onboarding/([a-zA-Z0-9-_]+)/?',
                'regex' => '#^/project/onboarding/[^/]+#',
                'file_name' => 'ProjectOnboarding'
            ],
            [
                'url' => '^project/problem/([a-zA-Z0-9-_]+)/?',
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

    function is_user_logged_in()
    {
        return isset($_SESSION['idToken']);
    }
}
