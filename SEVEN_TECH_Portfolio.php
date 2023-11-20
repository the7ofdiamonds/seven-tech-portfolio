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
use SEVEN_TECH\Portfolio\CSS\Customizer;
use SEVEN_TECH\Portfolio\Database\Database;
use SEVEN_TECH\Portfolio\Pages\Pages;
use SEVEN_TECH\Portfolio\Post_Types\Post_Types;
use SEVEN_TECH\Portfolio\Roles\Roles;
use SEVEN_TECH\Portfolio\Router\Router;
use SEVEN_TECH\Portfolio\Shortcodes\Shortcodes;
use SEVEN_TECH\Portfolio\Taxonomies\Taxonomies;
use SEVEN_TECH\Portfolio\Templates\Templates;

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
            // (new Pages)->react_rewrite_rules();
            // (new Pages)->is_user_logged_in();
            (new Post_Types)->custom_post_types();
            (new Router)->load_page();
            new Shortcodes;
            (new Taxonomies)->custom_taxonomy();
        });

        // add_action('customize_register', [(new Customizer), 'register_customizer_panel']);
        
        add_filter('taxonomy_template', [(new Templates), 'get_taxonomy_page_template']);

        add_filter('archive_template', [(new Templates), 'get_archive_page_template']);
        add_filter('single_template', [(new Templates), 'get_single_page_template']);

        // add_filter('query_vars', [(new Pages), 'add_query_vars']);
        flush_rewrite_rules();
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