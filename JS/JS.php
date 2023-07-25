<?php

namespace THFW_Portfolio\JS;

class JS
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'load_js']);
    }

    //Load Plugin JS
    function load_js()
    {
        wp_enqueue_script('thfw_portfolio_js', WP_PLUGIN_URL . '/thfw-portfolio/js/thfw-portfolio.js', array('jquery'), false, false);
    }
}
