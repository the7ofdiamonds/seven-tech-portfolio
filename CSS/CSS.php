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
        wp_enqueue_style('thfw_portfolio_css',  WP_PLUGIN_URL . '/thfw-portfolio/css/thfw-portfolio.css', array(), false, 'all');
    }
}
