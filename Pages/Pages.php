<?php

namespace THFW_Portfolio\Pages;

class Pages
{

    public function __construct()
    {
        add_filter('archive_template', [$this, 'get_custom_archive_template']);
        add_filter('single_template', [$this, 'get_custom_single_template']);
    }

    function get_custom_archive_template($archive_template)
    {
        if (is_post_type_archive('portfolio')) {
            $archive_template = THFW_PORTFOLIO . 'pages/archive-portfolio.php';
        }

        return $archive_template;
    }

    function get_custom_single_template($single_template)
    {
        global $post;

        if ($post->post_type == 'portfolio') {
            $single_template = THFW_PORTFOLIO . 'pages/single-portfolio.php';
        }

        return $single_template;
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
