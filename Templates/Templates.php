<?php

namespace THFW_Portfolio\Templates;

class Templates
{

    public function __construct()
    {
        add_action('init', [$this, 'portfolio_register_case_study_post_template']);
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
}
