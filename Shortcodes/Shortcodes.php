<?php

namespace SEVEN_TECH\Portfolio\Shortcodes;

use SEVEN_TECH\Portfolio\Post_Types\Portfolio\Portfolio;

class Shortcodes
{

    public function __construct()
    {
        add_shortcode('seven-tech-portfolio', [$this, 'portfolio_shortcode']);
    }

    function portfolio_shortcode()
    {
        $portfolio = new Portfolio;

        if(empty($portfolio->getPortfolio())){
            return '';
        }

        include SEVEN_TECH_PORTFOLIO . 'includes/react.php';
    }
}
