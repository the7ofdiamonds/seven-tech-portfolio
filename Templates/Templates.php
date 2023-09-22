<?php

namespace THFW_Portfolio\Templates;

class Templates
{

    public function __construct()
    {
        add_action('init', [$this, 'portfolio_register_case_study_post_template']);
        add_filter('template_include', [$this, 'get_custom_on_boarding_page_template']);
        add_filter('template_include', [$this, 'get_custom_problem_page_template']);
    }

    function portfolio_register_case_study_post_template()
    {
        register_block_type('post-type/case-study', array(
            'render_callback' => 'portfolio_render_case_study'
        ));
    }

    function portfolio_render_case_study($attributes, $content)
    {
        $reusable_block = get_post($attributes['reusableBlockID']);
        $reusable_block_content = $reusable_block->post_content;
        $reusable_block_html = parse_blocks($reusable_block_content);
        $reusable_block_output = '';
        foreach ($reusable_block_html as $block) {
            $reusable_block_output .= render_block($block);
        }

        // Output the rest of the block's content
        return '<div class="my-block">' . $reusable_block_output . $content . '</div>';
    }

    function get_custom_on_boarding_page_template($template)
    {
        $start_page = get_page_by_path('services/service/on-boarding');

        if ($start_page && is_page($start_page->ID)) {
            $custom_template = THFW_PORTFOLIO . 'Pages/page-on-boarding.php';

            if (file_exists($custom_template)) {
                return $custom_template;
            }
        }
        return $template;
    }

    function get_custom_problem_page_template($template)
    {
        $selections_page = get_page_by_path('services/service/on-boarding/the-problem');

        if ($selections_page && is_page($selections_page->ID)) {
            $custom_template = THFW_PORTFOLIO . 'Pages/page-the-problem.php';

            if (file_exists($custom_template)) {
                return $custom_template;
            }
        }
        return $template;
    }

}
