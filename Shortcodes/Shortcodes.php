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
        include THFW_PORTFOLIO . 'includes/section-portfolio.php';
    }
}
