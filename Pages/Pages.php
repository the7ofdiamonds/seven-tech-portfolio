<?php

namespace SEVEN_TECH\Portfolio\Pages;

class Pages
{
    public $front_page_react;
    public $custom_pages_list;
    public $protected_pages_list;
    public $pages_list;
    public $pages;
    public $page_titles;

    public function __construct()
    {
        $this->front_page_react = [
            'Portfolio',
        ];

        $this->custom_pages_list = [];

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
            ...$this->custom_pages_list,
            ...$this->protected_pages_list,
            ...$this->pages_list,
        ];

        $this->pages = [];
    }

    function add_pages()
    {
        global $wpdb;

        foreach ($this->pages as $page) {
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

    function is_user_logged_in()
    {
        return isset($_SESSION['idToken']);
    }
}
