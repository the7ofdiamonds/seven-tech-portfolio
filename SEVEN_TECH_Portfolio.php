<?php

namespace SEVEN_TECH_Portfolio;

/**
 * @package SEVEN_TECH_Portfolio
 */
/*
Plugin Name: SEVEN TECH Portfolio
Plugin URI: 
Description: Portfolio Custom Post Type.
Version: 1.0.0
Author: THE7OFDIAMONDS.TECH
Author URI: http://THE7OFDIAMONDS.TECH
License: 
Text Domain: seven-tech-portfolio
*/

/*
Licensing Info Here
*/

defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');
define('SEVEN_TECH_PORTFOLIO', WP_PLUGIN_DIR . '/seven-tech-portfolio/');
define('SEVEN_TECH_PORTFOLIO_URL', WP_PLUGIN_URL . '/seven-tech-portfolio/');

require_once SEVEN_TECH_PORTFOLIO . 'vendor/autoload.php';

use SEVEN_TECH_Portfolio\API\API;
use SEVEN_TECH_Portfolio\CSS\CSS;
use SEVEN_TECH_Portfolio\Database\Database;
use SEVEN_TECH_Portfolio\JS\JS;
use SEVEN_TECH_Portfolio\Pages\Pages;
use SEVEN_TECH_Portfolio\Post_Types\Post_Types;
use SEVEN_TECH_Portfolio\Shortcodes\Shortcodes;
use SEVEN_TECH_Portfolio\Taxonomies\Taxonomies;
use SEVEN_TECH_Portfolio\Templates\Templates;

class SEVEN_TECH_Portfolio
{
    public function __construct()
    {
        new API;
        new CSS;
        new Database;
        new JS;
        new Pages;
        new Post_Types;
        new Shortcodes;
        new Taxonomies;
        new Templates;
    }

    function activate()
    {
        flush_rewrite_rules();
    }
}

$seven_tech_portfolio = new SEVEN_TECH_Portfolio();
register_activation_hook(__FILE__, array($seven_tech_portfolio, 'activate'));
// register_deactivation_hook( __FILE__, array( $seven_tech_portfolio, 'deactivate' ) );