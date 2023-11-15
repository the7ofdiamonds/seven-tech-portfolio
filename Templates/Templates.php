<?php

namespace SEVEN_TECH\Portfolio\Templates;

use SEVEN_TECH\Portfolio\CSS\CSS;
use SEVEN_TECH\Portfolio\JS\JS;
use SEVEN_TECH\Portfolio\Post_Types\Post_Type_Portfolio;
use SEVEN_TECH\Portfolio\Shortcodes\Shortcodes;
use SEVEN_TECH\Portfolio\Post_Types\Post_Types;
use SEVEN_TECH\Portfolio\Taxonomies\Taxonomies;

class Templates
{
    private $css_file;
    private $js_file;
    private $shortcodes;
    private $post_types;
    private $taxonomies;
    private $post_types_list;
    private $taxonomies_list;
    private $portfolio;

    public function __construct()
    {
        $this->post_types = new Post_Types();
        $this->taxonomies = new Taxonomies;

        $this->post_types_list = $this->post_types->post_types_list;
        $this->taxonomies_list = $this->taxonomies->taxonomies_list;

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
        if (!empty($this->post_types_list)) {
            foreach ($this->post_types_list as $post_type_name => $post_type_class) {
                do_action('init_post_type', $post_type_class);
                if (is_post_type_archive($post_type_name)) {
                    $archive_template = SEVEN_TECH_PORTFOLIO . 'Post_Types/' . ucfirst($post_type_name) . '/archive-' . $post_type_name . '.php';

                    if (file_exists($archive_template)) {
                        add_action('wp_head', [$this->css_file, 'load_post_types_css']);
                        add_action('wp_footer', [$this->js_file, 'load_post_types_archive_react']);

                        return $archive_template;
                    } else {
                        error_log('can not find temlate');
                        return $archive_template;
                    }
                }
            }
        }

        return $archive_template;
    }


    function get_single_page_template($single_template)
    {
        if (!empty($this->post_types_list)) {
            foreach ($this->post_types_list as $post_type_name => $post_type_class) {

                if (is_singular($post_type_name)) {
                    $single_template = SEVEN_TECH_PORTFOLIO . 'Post_Types/' . ucfirst($post_type_name) . '/single-' . $post_type_name . '.php';

                    if (file_exists($single_template)) {
                        add_action('wp_head', [$this->css_file, 'load_post_types_css']);
                        add_action('wp_footer', [$this->js_file, 'load_post_types_single_react']);
                        add_action('init', function () {
                            $this->post_types;
                            $this->taxonomies;
                        });
                    }

                    break;
                }
            }
        }

        return $single_template;
    }

    function get_taxonomy_page_template($taxonomy_template)
    {
        if (!empty($this->taxonomies_list)) {
            foreach ($this->taxonomies_list as $taxonomy) {

                if (is_tax($taxonomy['name'])) {
                    $taxonomy_template = SEVEN_TECH_PORTFOLIO . 'Post_Types/' . $taxonomy['plural'] . '/single-' . $taxonomy['name'] . '.php';

                    if (file_exists($taxonomy_template)) {
                        add_action('wp_head', [$this->css_file, 'load_post_types_css']);
                        add_action('wp_footer', [$this->js_file, 'load_post_types_single_react']);
                        add_action('init', function () {
                            $this->post_types;
                            $this->taxonomies;
                        });
                    }

                    break;
                }
            }
        }

        return $taxonomy_template;
    }
}
