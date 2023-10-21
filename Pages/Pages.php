<?php

namespace SEVEN_TECH_Portfolio\Pages;

class Pages
{
    private $page_titles;

    public function __construct()
    {
        $this->page_titles = [
    
        ];

        add_action('init', [$this, 'react_rewrite_rules']);
    }

    public function add_pages()
    {
        global $wpdb;

        foreach ($this->page_titles as $page_title) {
            $page_exists = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'page'", $page_title));

            if (!$page_exists) {
                $page_data = array(
                    'post_title'   => $page_title,
                    'post_type'    => 'page',
                    'post_content' => '',
                    'post_status'  => 'publish',
                );

                wp_insert_post($page_data);
            }
        }
    }

    function add_client_on_boarding()
    {
        global $wpdb;

        $page_title = 'ON BOARDING';

        $page_exists = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'page'", $page_title));

        $parent_page_id = get_page_by_path('client')->ID;

        if (!$page_exists) {
            $page_data = array(
                'post_title'   => $page_title,
                'post_type'    => 'page',
                'post_content' => '',
                'post_status'  => 'publish',
                'post_parent'   => $parent_page_id,
            );

            wp_insert_post($page_data);
        }
    }

    function add_on_boarding_problem()
    {
        global $wpdb;

        $page_title = 'THE PROBLEM';

        $page_exists = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'page'", $page_title));
        $parent_id = get_page_by_path('client/on-boarding')->ID;

        if (!$page_exists) {
            $page_data = array(
                'post_title'   => $page_title,
                'post_type'    => 'page',
                'post_content' => '',
                'post_status'  => 'publish',
                'post_parent'   => $parent_id,
            );

            wp_insert_post($page_data);
        } 
    }

    public function react_rewrite_rules()
    {
        $on_boarding_page = get_page_by_path('client/on-boarding');
        $the_problem_page = get_page_by_path('client/on-boarding/the-problem');

        if ($on_boarding_page && $the_problem_page) {
            add_rewrite_rule('^client/([^/]+)/?$', 'index.php?page_id=' . $on_boarding_page->ID, 'top');
            add_rewrite_rule('^client/([^/]+)/on-boarding/?$', 'index.php?page_id=' . $the_problem_page->ID, 'top');
        }
    }

    function is_user_logged_in()
    {
        return isset($_SESSION['idToken']);
    }
}
