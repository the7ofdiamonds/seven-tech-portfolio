<?php

namespace THFW_Portfolio\JS;

class JS
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'load_js']);
        add_action('wp_enqueue_scripts', [$this, 'load_react']);
    }

    function load_js()
    {
        wp_enqueue_script('7tech_portfolio_js', THFW_PORTFOLIO_URL . 'JS/thfw-portfolio.js', array('jquery'), false, false);
    }

    function get_js_files($directory)
    {
        $jsFiles = array();
        $files = scandir($directory);

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'js') {
                $jsFiles[] = $file;
            }
        }
        return $jsFiles;
    }

    function load_react()
    {
        $directory = THFW_PORTFOLIO . 'build';
        $pages = [
            'founder',
            'services/service/on-boarding',
            'services/service/on-boarding/the-problem',
        ];

        if (is_front_page() || is_archive('portfolio') || is_singular('portfolio') || is_page($pages) || is_tax('project_types') || is_tax('project_tags')) {
            $jsFiles = $this->get_js_files($directory);

            if ($jsFiles) {
                foreach ($jsFiles as $jsFile) {
                    $handle = '7tech_portfolio_react_' . basename($jsFile);
                    wp_enqueue_script($handle, THFW_PORTFOLIO_URL . 'build/' . $jsFile, ['wp-element'], 1.0, true);
                }
            }
        }
    }
}
