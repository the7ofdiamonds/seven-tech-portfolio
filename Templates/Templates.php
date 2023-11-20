<?php

namespace SEVEN_TECH\Portfolio\Templates;

use SEVEN_TECH\Portfolio\CSS\CSS;
use SEVEN_TECH\Portfolio\JS\JS;
use SEVEN_TECH\Portfolio\Post_Types\Post_Types;
use SEVEN_TECH\Portfolio\Shortcodes\Shortcodes;
use SEVEN_TECH\Portfolio\Taxonomies\Taxonomies;

class Templates
{
    private $post_types_list;
    private $taxonomies_list;
    private $css_file;
    private $js_file;
    private $shortcodes;

    public function __construct()
    {
        $post_types = new Post_Types();
        $taxonomies = new Taxonomies;

        $this->post_types_list = $post_types->post_types_list;
        $this->taxonomies_list = $taxonomies->taxonomies_list;

        $this->css_file = new CSS;
        $this->js_file = new JS;
        $this->shortcodes = new Shortcodes;

    }

    function get_front_page_template($frontpage_template)
    {
        if (is_front_page()) {
            add_action('wp_head', [$this->css_file, 'load_front_page_css']);
            add_action('wp_footer', [$this->js_file, 'load_front_page_react']);
            add_shortcode('seven-tech-portfolio', [$this->shortcodes, 'portfolio_shortcode']);
        }

        return $frontpage_template;
    }

    function get_page_template($template)
    {
        $template = SEVEN_TECH_PORTFOLIO . 'Pages/page.php';;

        if (file_exists($template)) {
            add_action('wp_head', [$this->css_file, 'load_pages_css']);
            add_action('wp_footer', [$this->js_file, 'load_pages_react']);

            return $template;
        } else {
            error_log('Page Template does not exist.');
        }

        return $template;
    }

    function get_protected_page_template($template)
    {
        $template = SEVEN_TECH_PORTFOLIO . 'Pages/page-protected.php';

        if (file_exists($template)) {
            add_action('wp_head', [$this->css_file, 'load_pages_css']);
            add_action('wp_footer', [$this->js_file, 'load_pages_react']);
            return $template;
        } else {
            error_log('Protected Page Template does not exist.');
        }

        return $template;
    }

    public function get_archive_page_template($archive_template)
    {
        if (is_array($this->post_types_list)) {
            foreach ($this->post_types_list as $post_type) {

                if (is_post_type_archive($post_type['name'])) {
                    add_action('wp_head', [$this->css_file, 'load_post_types_css']);
                    $archive_template = SEVEN_TECH_PORTFOLIO . 'Post_Types/' . ucfirst($post_type['name']) . '/archive-' . $post_type['name'] . '.php';
                    add_action('wp_footer', [$this->js_file, 'load_post_types_archive_react']);

                    if (file_exists($archive_template)) {
                        return $archive_template;
                    }
                    
                    break;
                }
            }
        }

        return $archive_template;
    }


    function get_single_page_template($single_template)
    {
        if (is_array($this->post_types_list)) {
            foreach ($this->post_types_list as $post_type) {

                if (is_singular($post_type['name'])) {
                    add_action('wp_head', [$this->css_file, 'load_post_types_css']);
                    $single_template = SEVEN_TECH_PORTFOLIO . 'Post_Types/' . ucfirst($post_type['name']) . '/single-' . $post_type['name'] . '.php';
                    add_action('wp_footer', [$this->js_file, 'load_post_types_single_react']);

                    if (file_exists($single_template)) {
                        return $single_template;
                    }

                    break;
                }
            }
        }

        return $single_template;
    }

    function get_taxonomy_page_template($taxonomy_template)
    {
        if (is_array($this->taxonomies_list)) {
            foreach ($this->taxonomies_list as $taxonomy) {

                if (is_tax($taxonomy['taxonomy'])) {
                    add_action('wp_head', [$this->css_file, 'load_taxonomies_css']);
                    $taxonomy_template = SEVEN_TECH_PORTFOLIO . "Taxonomies/taxonomy-{$taxonomy['file_name']}.php";
                    add_action('wp_footer', [$this->js_file, 'load_taxonomies_react']);

                    if (file_exists($taxonomy_template)) {              
                        return $taxonomy_template;
                    }

                    break;
                } 
            }
        }

        return $taxonomy_template;
    }
}
