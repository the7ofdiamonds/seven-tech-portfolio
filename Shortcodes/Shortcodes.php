<?php

namespace THFW_Portfolio\Shortcodes;

class Shortcodes
{

    public function __construct()
    {
        add_shortcode('thfw-portfolio', [$this, 'portfolio_shortcode']);
    }

    function portfolio_shortcode()
    {
        include WP_PLUGIN_DIR . '/thfw-portfolio/includes/section-portfolio.php';
    }
}
