<?php

namespace SEVEN_TECH_Portfolio\Templates;

use SEVEN_TECH_Portfolio\CSS\CSS;
use SEVEN_TECH_Portfolio\JS\JS;

class Templates_Taxonomies
{
    private $css_file;
    private $js_file;

    public function __construct()
    {
        add_filter('taxonomy_template', [$this, 'get_project_types_taxonomy_template']);
        add_filter('taxonomy_template', [$this, 'get_project_tags_taxonomy_template']);

        $this->css_file = new CSS;
        $this->js_file = new JS;
    }

    function get_project_types_taxonomy_template($taxonomy_template)
    {
        if (is_tax('project_types')) {
            $taxonomy_template = SEVEN_TECH_PORTFOLIO . 'Pages/page-portfolio-types.php';
            
            if (file_exists($taxonomy_template)) {
                add_action('wp_head', [$this->css_file, 'load_taxonomies_css']);
                add_action('wp_footer', [$this->js_file, 'load_taxonomies_react']);

                return $taxonomy_template;
            }
        }
        
        return $taxonomy_template;
    }

    function get_project_tags_taxonomy_template($taxonomy_template)
    {
        if (is_tax('project_tags')) {
            $taxonomy_template = SEVEN_TECH_PORTFOLIO . 'Pages/page-portfolio-tags.php';
            
            if (file_exists($taxonomy_template)) {
                add_action('wp_head', [$this->css_file, 'load_taxonomies_css']);
                add_action('wp_footer', [$this->js_file, 'load_taxonomies_react']);

                return $taxonomy_template;
            }
        }

        return $taxonomy_template;
    }
}
