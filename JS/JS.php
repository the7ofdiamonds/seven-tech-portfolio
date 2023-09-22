<?php

namespace THFW_Portfolio\JS;

class JS
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'load_js']);
        add_action('wp_enqueue_scripts', [$this, 'load_react']);
    }

    //Load Plugin JS
    function load_js()
    {
        wp_enqueue_script('thfw_portfolio_js', THFW_PORTFOLIO_URL . 'JS/thfw-portfolio.js', array('jquery'), false, false);
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
            'services/service/on-boarding',
            'services/service/on-boarding/the-problem',
        ];

        if (is_front_page()|| is_page($pages)) {
            $jsFiles = $this->get_js_files($directory);

            if ($jsFiles) {
                foreach ($jsFiles as $jsFile) {
                    $handle = 'thfw_portfolio_react_' . basename($jsFile);
                    wp_enqueue_script($handle, THFW_PORTFOLIO_URL . 'build/' . $jsFile, ['wp-element'], 1.0, true);
                }
            }
        }
    }
}
