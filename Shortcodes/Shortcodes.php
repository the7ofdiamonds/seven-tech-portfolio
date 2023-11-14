<?php

namespace SEVEN_TECH\Portfolio\Shortcodes;

class Shortcodes
{

    public function __construct()
    {
    }

    function portfolio_shortcode()
    {
        include SEVEN_TECH_PORTFOLIO . 'includes/react.php';
    }
}
