<?php

namespace SEVEN_TECH\Portfolio\Pages;

class Pages
{
    public $front_page_react;
    public $custom_pages;
    public $protected_pages;
    public $pages_list;
    public $pages;

    public function __construct()
    {
        $this->front_page_react = [
            'Portfolio',
        ];

        $this->custom_pages = [
            [
                'url' => '^founders/([a-zA-Z0-9-_]+)/?',
                'regex' => '#^/founders/([a-zA-Z0-9-_]+)+#',
                'file_name' => 'User'
            ],
            [
                'url' => '^investors/([a-zA-Z0-9-_]+)/?',
                'regex' => '#^/investors/([a-zA-Z0-9-_]+)+#',
                'file_name' => 'User'
            ],
            [
                'url' => '^managing-members/([a-zA-Z0-9-_]+)/?',
                'regex' => '#^/managing-members/([a-zA-Z0-9-_]+)+#',
                'file_name' => 'User'
            ],
            [
                'url' => '^executives/([a-zA-Z0-9-_]+)/?',
                'regex' => '#^/executives/([a-zA-Z0-9-_]+)+#',
                'file_name' => 'User'
            ],
            [
                'url' => '^freelancers/([a-zA-Z0-9-_]+)/?',
                'regex' => '#^/freelancers/([a-zA-Z0-9-_]+)+#',
                'file_name' => 'User'
            ],
            [
                'url' => '^employees/([a-zA-Z0-9-_]+)/?',
                'regex' => '#^/employees/([a-zA-Z0-9-_]+)+#',
                'file_name' => 'User'
            ],
            [
                'url' => '^frameworks/([a-zA-Z0-9-_]+)/?',
                'regex' => '#^/frameworks/([a-zA-Z0-9-_]+)+#',
                'file_name' => 'Term'
            ],
            [
                'url' => '^frameworks?',
                'regex' => '#^/frameworks#',
                'file_name' => 'Taxonomy'
            ],
            [
                'url' => '^skills/([a-zA-Z0-9-_]+)/?',
                'regex' => '#^/skills/([a-zA-Z0-9-_]+)+#',
                'file_name' => 'Term'
            ],
            [
                'url' => '^skills?',
                'regex' => '#^/skills#',
                'file_name' => 'Taxonomy'
            ],
            [
                'url' => '^technologies/([a-zA-Z0-9-_]+)/?',
                'regex' => '#^/technologies/([a-zA-Z0-9-_]+)+#',
                'file_name' => 'Term'
            ],
            [
                'url' => '^technologies?',
                'regex' => '#^/technologies#',
                'file_name' => 'Taxonomy'
            ],
            [
                'url' => '^dashboard?',
                'regex' => '#^/dashboard#',
                'file_name' => 'Dashboard'
            ],
        ];

        $this->protected_pages = [
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

        $this->pages = [];

        $this->pages_list = [];
    }

    function add_pages()
    {
        if (!empty($this->pages_list)) {
            global $wpdb;

            foreach ($this->pages_list as $page) {
                if (!empty($page['title'])) {
                    $page_exists = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'page'", $page['title']));

                    if (!$page_exists) {
                        $page_data = array(
                            'post_title'   => $page['title'],
                            'post_type'    => 'page',
                            'post_content' => '',
                            'post_status'  => 'publish',
                        );

                        wp_insert_post($page_data);

                        error_log($page['title'] . ' page added.');
                    }
                }
            }
        }
    }

    function is_user_logged_in()
    {
        return isset($_SESSION['idToken']);
    }
}
