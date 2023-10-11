<?php

namespace THFW_Portfolio\CSS;

class CSS
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'load_css']);
    }

    function load_css()
    {
        $pages = [
            'founder',
            'client/on-boarding',
            'client/on-boarding/the-problem'
        ];

        if (is_front_page() || is_post_type_archive('portfolio') || is_single('portfolio') || is_page($pages)) {
            wp_enqueue_style('thfw_portfolio_css',  THFW_PORTFOLIO_URL . 'CSS/thfw-portfolio.css', array(), false, 'all');
        }
    }
}
