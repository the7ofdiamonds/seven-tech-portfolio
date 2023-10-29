<?php

namespace SEVEN_TECH_Portfolio\Templates;

use SEVEN_TECH_Portfolio\CSS\CSS;
use SEVEN_TECH_Portfolio\JS\JS;

class Templates
{
    private $css_file;
    private $js_file;

    public function __construct()
    {
        add_filter('frontpage_template', [$this, 'get_custom_front_page']);

        add_filter('template_include', [$this, 'get_custom_on_boarding_page_template']);
        add_filter('template_include', [$this, 'get_custom_problem_page_template']);

        $this->css_file = new CSS;
        $this->js_file = new JS;

        new Templates_Post_types;
        new Templates_Taxonomies;
    }

    function get_custom_front_page($frontpage_template)
    {
        if (is_front_page()) {
            add_action('wp_head', [$this->css_file, 'load_front_page_css']);
            add_action('wp_footer', [$this->js_file, 'load_front_page_react']);
        }

        return $frontpage_template;
    }

    function get_custom_on_boarding_page_template($page_template)
    {
        if (get_query_var('onboarding')) {
            $page_template = SEVEN_TECH_PORTFOLIO . 'Pages/page-on-boarding.php';

            if (file_exists($page_template)) {
                add_action('wp_head', [$this->css_file, 'load_pages_css']);
                add_action('wp_footer', [$this->js_file, 'load_pages_react']);

                return $page_template;
            } else {
                error_log('Onboarding Page Template does not exist.');
            }
        }

        return $page_template;
    }

    function get_custom_problem_page_template($page_template)
    {
        if (get_query_var('problem')) {
            $page_template = SEVEN_TECH_PORTFOLIO . 'Pages/page-the-problem.php';

            if (file_exists($page_template)) {
                add_action('wp_head', [$this->css_file, 'load_pages_css']);
                add_action('wp_footer', [$this->js_file, 'load_pages_react']);

                return $page_template;
            } else {
                error_log('Problem Page Template does not exist.');
            }
        }

        return $page_template;
    }
}
