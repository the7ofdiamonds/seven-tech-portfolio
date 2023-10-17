<?php

namespace SEVEN_TECH_Portfolio\Shortcodes;

class Shortcodes
{

    public function __construct()
    {
        add_shortcode('thfw-portfolio', [$this, 'portfolio_shortcode']);
    }

    function portfolio_shortcode()
    {
        include SEVEN_TECH_PORTFOLIO . 'includes/section-portfolio.php';
    }
}
