<?php

namespace SEVEN_TECH\Portfolio\Admin;

use SEVEN_TECH\Portfolio\Taxonomies\ProjectTypes;

class Admin
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'register_custom_menu_page']);

        new ProjectTypes;
    }

    public function register_custom_menu_page()
    {
        add_menu_page(
            '',
            'PORTFOLIO',
            'manage_options',
            'seven-tech-portfolio',
            '',
            'dashicons-info',
            105
        );

        add_submenu_page(
            'seven-tech-portfolio',
            'SEVEN TECH PORTFOLIO',
            'Dashboard',
            'manage_options',
            'seven-tech-portfolio',
            [$this, 'create_section'],
            0
        );

        add_action('admin_init', [$this, 'register_section']);
    }

    function create_section()
    {
        include_once SEVEN_TECH_PORTFOLIO . 'Admin/includes/admin.php';
    }

    function register_section()
    {
        add_settings_section('seven-tech-portfolio-group', 'SEVEN TECH PORTFOLIO', '', 'seven-tech-portfolio');
    }
}
