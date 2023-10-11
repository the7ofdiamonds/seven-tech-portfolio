<?php

namespace THFW_Portfolio\CSS;

class CSS
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'load_css']);
    }

    //Load Plugin CSS & JS
    function load_css()
    {
        $onboarding_page = get_page_by_path('services/service/on-boarding');
        $problem_page = get_page_by_path('services/service/on-boarding/the-problem');

        if (is_front_page() || is_post_type_archive('portfolio') || is_single('portfolio') || is_page('founder') || is_page($onboarding_page->ID) || is_page($problem_page->ID)) {
            wp_enqueue_style('thfw_portfolio_css',  THFW_PORTFOLIO_URL . 'CSS/thfw-portfolio.css', array(), false, 'all');
        }
    }
}
