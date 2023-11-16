<?php

namespace SEVEN_TECH\Portfolio\Shortcodes;

class Shortcodes
{

    public function __construct()
    {
        add_shortcode('seven-tech-portfolio', [$this, 'portfolio_shortcode']);
    }

    function portfolio_shortcode()
    {
        include SEVEN_TECH_PORTFOLIO . 'includes/react.php';
    }
}
