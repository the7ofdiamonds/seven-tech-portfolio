<?php

namespace THFW_Portfolio\Templates;

class Templates
{

    public function __construct()
    {
        add_filter('archive_template', [$this, 'get_custom_archive_template']);
        add_filter('single_template', [$this, 'get_custom_single_template']);
        add_filter('page_template', [$this, 'get_founder_page_template']);
        add_filter('template_include', [$this, 'get_founder_resume_page_template']);
        add_filter('template_include', [$this, 'get_custom_on_boarding_page_template']);
        add_filter('template_include', [$this, 'get_custom_problem_page_template']);
    }

    function get_custom_archive_template($archive_template)
    {
        if (is_post_type_archive('portfolio')) {
            $archive_template = THFW_PORTFOLIO . 'pages/archive-portfolio.php';
        }

        return $archive_template;
    }

    function get_custom_single_template($single_template)
    {
        global $post;

        if ($post->post_type == 'portfolio') {
            $single_template = THFW_PORTFOLIO . 'pages/single-portfolio.php';
        }

        return $single_template;
    }

    function get_founder_page_template($page_template)
    {
        if (is_page('founder')) {
            $page_template = THFW_PORTFOLIO . 'Pages/page-founder.php';
        }

        return $page_template;
    }

    function get_founder_resume_page_template($template)
    {
        $resume_page = get_page_by_path('founder/resume');

        if ($resume_page && is_page($resume_page->ID)) {
            $custom_template = THFW_PORTFOLIO . 'Pages/page-founder-resume.php';

            if (file_exists($custom_template)) {
                return $custom_template;
            }
        }

        return $template;
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
