<?php

namespace SEVEN_TECH_Portfolio\Templates;

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
            $archive_template = SEVEN_TECH_PORTFOLIO . 'Post_Types/Portfolio/archive-portfolio.php';

            if (file_exists($archive_template)) {
                return $archive_template;
            } else {
                error_log('Portfolio Post Type Archive Template does not exist.');
            }
        }

        return $archive_template;
    }

    function get_custom_single_template($single_template)
    {
        if (is_singular('portfolio')) {
            $single_template = SEVEN_TECH_PORTFOLIO . 'Post_Types/Portfolio/single-portfolio.php';

            if (file_exists($single_template)) {
                return $single_template;
            } else {
                error_log('Portfolio Post Type Single Template does not exist.');
            }
        }

        return $single_template;
    }

    function get_founder_page_template($page_template)
    {
        if (is_page('founder')) {
            $page_template = SEVEN_TECH_PORTFOLIO . 'Pages/page-founder.php';

            if (file_exists($page_template)) {
                return $page_template;
            } else {
                error_log('Founder Page Template does not exist.');
            }
        }

        return $page_template;
    }

    function get_founder_resume_page_template($page_template)
    {
        $resume_page = get_page_by_path('founder/resume');

        if ($resume_page && is_page($resume_page->ID)) {
            $page_template = SEVEN_TECH_PORTFOLIO . 'Pages/page-founder-resume.php';

            if (file_exists($page_template)) {
                return $page_template;
            } else {
                error_log('Resume Page Template does not exist.');
            }
        }

        return $page_template;
    }

    function get_custom_on_boarding_page_template($page_template)
    {
        $onboarding_page = get_page_by_path('client/on-boarding');

        if ($onboarding_page && is_page($onboarding_page->ID)) {
            $page_template = SEVEN_TECH_PORTFOLIO . 'Pages/page-on-boarding.php';

            if (file_exists($page_template)) {
                return $page_template;
            } else {
                error_log('Onboarding Page Template does not exist.');
            }
        }

        return $page_template;
    }

    function get_custom_problem_page_template($page_template)
    {
        $problem_page = get_page_by_path('client/on-boarding/the-problem');

        if ($problem_page && is_page($problem_page->ID)) {
            $page_template = SEVEN_TECH_PORTFOLIO . 'Pages/page-the-problem.php';

            if (file_exists($page_template)) {
                return $page_template;
            } else {
                error_log('Problem Page Template does not exist.');
            }
        }

        return $page_template;
    }
}
