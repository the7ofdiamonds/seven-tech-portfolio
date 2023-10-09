<?php

namespace THFW_Portfolio\Pages;

class Pages
{
    private $page_titles;

    public function __construct()
    {
        $this->page_titles = [
            'FOUNDER'
        ];
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

    function add_services_on_boarding()
    {
        global $wpdb;

        $page_title = 'ON BOARDING';

        $page_exists = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'page'", $page_title));

        $parent_page_id = get_page_by_path('services/service')->ID;

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
        $parent_id = get_page_by_path('services/service/on-boarding')->ID;

        if (!$page_exists) {
            $page_data = array(
                'post_title'   => $page_title,
                'post_type'    => 'page',
                'post_content' => '',
                'post_status'  => 'publish',
                'post_parent'   => $parent_id,
            );

            wp_insert_post($page_data);
        } else {
            error_log('page exist');
        }
    }

    public function react_rewrite_rules()
    {
        $on_boarding_page_id = get_page_by_path('services/service/on-boarding')->ID;
        $the_problem_page_id = get_page_by_path('services/service/on-boarding/the-problem')->ID;

        add_rewrite_rule('^services/([^/]+)/?$', 'index.php?page_id=' . $on_boarding_page_id, 'top');
        add_rewrite_rule('^services/([^/]+)/on-boarding/?$', 'index.php?page_id=' . $the_problem_page_id, 'top');
    }

    function is_user_logged_in()
    {
        return isset($_SESSION['idToken']);
    }
}
