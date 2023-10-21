<?php

namespace SEVEN_TECH_Portfolio\CSS;

class CSS
{

    public function __construct()
    {
        add_action('wp_head', [$this, 'load_css']);
    }

    function load_css()
    {
        $pages = [
            'client/on-boarding',
            'client/on-boarding/the-problem'
        ];

        if (is_front_page() || is_archive('portfolio') || is_singular('portfolio') || is_page($pages)) {
            wp_enqueue_style('seven_tech_portfolio_css',  SEVEN_TECH_PORTFOLIO_URL . 'CSS/seven-tech-portfolio.css', array(), false, 'all');
        }
    }
}
