<?php

namespace THFW_Portfolio;

/**
 * @package THFW_Portfolio
 */
/*
Plugin Name: THFW Portfolio
Plugin URI: 
Description: Portfolio Custom Post Type.
Version: 1.0.0
Author: THE7OFDIAMONDS.TECH
Author URI: http://THE7OFDIAMONDS.TECH
License: 
Text Domain: thfw-portfolio
*/

/*
Licensing Info Here
*/

defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');
define('THFW_PORTFOLIO', WP_PLUGIN_DIR . '/thfw-portfolio/');
define('THFW_PORTFOLIO_URL', WP_PLUGIN_URL . '/thfw-portfolio/');

require_once THFW_PORTFOLIO . 'vendor/autoload.php';

use THFW_Portfolio\API\API;
use THFW_Portfolio\CSS\CSS;
use THFW_Portfolio\Database\Database;
use THFW_Portfolio\JS\JS;
use THFW_Portfolio\Menus\Menus;
use THFW_Portfolio\Pages\Pages;
use THFW_Portfolio\Post_Types\Portfolio;
use THFW_Portfolio\Shortcodes\Shortcodes;
use THFW_Portfolio\Taxonomies\Taxonomies;
use THFW_Portfolio\Templates\Templates;

class THFW_Portfolio
{
    public function __construct()
    {
        new API;
        new CSS;
        new Database;
        new JS;
        new Pages;
        new Portfolio;
        new Shortcodes;
        new Taxonomies;
        new Templates;
    }

    function activate()
    {
        flush_rewrite_rules();
    }
}

$thfw_portfolio = new THFW_Portfolio();
register_activation_hook(__FILE__, array($thfw_portfolio, 'activate'));
// register_deactivation_hook( __FILE__, array( $thfw_portfolio, 'deactivate' ) );

$thfw_portfolio_pages = new Pages();
register_activation_hook(__FILE__, [$thfw_portfolio_pages, 'add_pages']);
register_activation_hook(__FILE__, [$thfw_portfolio_pages, 'add_services_on_boarding']);
register_activation_hook(__FILE__, [$thfw_portfolio_pages, 'add_on_boarding_problem']);

$thfw_portfolio_menus = new Menus();
register_activation_hook(__FILE__, [$thfw_portfolio_menus, 'create_mobile_menu']);
register_activation_hook(__FILE__, [$thfw_portfolio_menus, 'create_left_menu']);

//Uninstall move post type to trash