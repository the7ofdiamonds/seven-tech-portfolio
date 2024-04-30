<?php

namespace SEVEN_TECH\Portfolio;

/**
 * @package SEVEN_TECH_Portfolio
 */
/*
Plugin Name: SEVEN TECH Portfolio
Plugin URI: 
Description: Portfolio.
Version: 1.0.0
Author: THE7OFDIAMONDS.TECH
Author URI: http://THE7OFDIAMONDS.TECH
License: 
Text Domain: seven-tech-portfolio
*/

/*
Licensing Info Here
*/

// defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');
define('SEVEN_TECH_PORTFOLIO', WP_PLUGIN_DIR . '/seven-tech-portfolio/');
define('SEVEN_TECH_PORTFOLIO_URL', WP_PLUGIN_URL . '/seven-tech-portfolio/');

require_once SEVEN_TECH_PORTFOLIO . 'vendor/autoload.php';

use SEVEN_TECH\Portfolio\Admin\Admin;
use SEVEN_TECH\Portfolio\API\API;
use SEVEN_TECH\Portfolio\CSS\CSS;
use SEVEN_TECH\Portfolio\CSS\Customizer;
use SEVEN_TECH\Portfolio\Database\Database;
use SEVEN_TECH\Portfolio\JS\JS;
use SEVEN_TECH\Portfolio\Pages\Pages;
use SEVEN_TECH\Portfolio\Post_Types\Post_Types;
use SEVEN_TECH\Portfolio\Roles\Roles;
use SEVEN_TECH\Portfolio\Router\Router;
use SEVEN_TECH\Portfolio\Shortcodes\Shortcodes;
use SEVEN_TECH\Portfolio\Taxonomies\Taxonomies;
use SEVEN_TECH\Portfolio\Templates\Templates;

class SEVEN_TECH_Portfolio
{
    public $pages;
    public $css;
    public $js;
    public $posttypes;
    public $router;
    public $templates;

    public function __construct()
    {
        $plugin = plugin_basename(__FILE__);
        add_filter("plugin_action_links_{$plugin}", [$this, 'settings_link']);

        $admin = new Admin;

        add_action('admin_init', function () use ($admin) {
            $admin;
        });

        add_action('rest_api_init', function () {
            new API;
            (new API)->allow_cors_headers();
        });

        $pages = new Pages;
        $posttypes = new Post_Types;
        $taxonomies = new Taxonomies;
        $css = new CSS;
        $js = new JS;
        $templates = new Templates(
            $css,
            $js,
        );
        $router = new Router(
            $pages,
            $posttypes,
            $taxonomies,
            $templates
        );
        $shortcodes = new Shortcodes;

        add_action('init', function () use ($posttypes, $taxonomies, $router, $shortcodes) {
            $posttypes->custom_post_types();
            $taxonomies->customTaxonomy();
            $router->react_rewrite_rules();
            $router->load_page();
            $shortcodes;
        });

        $this->router = new Router(
            $pages,
            $posttypes,
            $taxonomies,
            $templates
        );
        $this->pages = new Pages;
    }

    function activate()
    {
        (new Database)->createTables();
        (new Roles)->add_roles();
        $this->pages->add_pages();
        $this->router->react_rewrite_rules();
    }

    function deactivate()
    {
        flush_rewrite_rules();
    }

    public function settings_link($links)
    {
        $settings_link = '<a href="' . admin_url('admin.php?page=seven-tech-portfolio') . '">Settings</a>';
        array_push($links, $settings_link);

        return $links;
    }
}

$seven_tech_portfolio = new SEVEN_TECH_Portfolio();
register_activation_hook(__FILE__, array($seven_tech_portfolio, 'activate'));
register_deactivation_hook(__FILE__, array($seven_tech_portfolio, 'deactivate'));
