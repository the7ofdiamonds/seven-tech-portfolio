<?php

namespace SEVEN_TECH\Portfolio;

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

use SEVEN_TECH\Portfolio\Admin\Admin;
use SEVEN_TECH\Portfolio\API\API;
use SEVEN_TECH\Portfolio\Database\Database;
use SEVEN_TECH\Portfolio\Post_Types\Post_Types;
use SEVEN_TECH\Portfolio\Roles\Roles;
use SEVEN_TECH\Portfolio\Router\Router;
use SEVEN_TECH\Portfolio\Taxonomies\Taxonomies;

class SEVEN_TECH_Portfolio
{
    public function __construct()
    {
        add_action('admin_init', function () {
            new Admin;
        });

        add_action('rest_api_init', function () {
            new API;
        });

        add_action('init', function () {
            (new Router)->load_page();
           (new Post_Types)->custom_post_types();
            (new Taxonomies)->custom_taxonomy();
        });
    }

    function activate()
    {
        flush_rewrite_rules();
        (new Database)->createTables();
        (new Roles)->add_roles();
    }
}

$seven_tech_portfolio = new SEVEN_TECH_Portfolio();
register_activation_hook(__FILE__, array($seven_tech_portfolio, 'activate'));
// register_deactivation_hook( __FILE__, array( $seven_tech_portfolio, 'deactivate' ) );