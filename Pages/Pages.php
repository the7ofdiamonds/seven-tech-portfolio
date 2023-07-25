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
}
