<?php

namespace SEVEN_TECH_Portfolio\Database;

class Database
{
    private $wpdb;
    public $project_table;
    public $project_onboarding_table;
    public $project_problem_table;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;

        $table_prefix = 'SEVEN_TECH_Portfolio';

        $this->project_table = $table_prefix;
        $this->project_onboarding_table = $table_prefix . '_project_onboarding';
        $this->project_problem_table = $table_prefix . '_project_problem';

        $this->createTables();

        new DatabaseProject($this->project_table);
        new DatabaseOnboarding($this->project_onboarding_table);
        new DatabaseTheProblem($this->project_problem_table);
    }

    function createTables()
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        $this->create_onboarding_table();
        $this->create_problem_table();
        $this->create_project_table();
    }

    function create_project_table()
    {
        $charset_collate = $this->wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$this->project_table} (
        id INT NOT NULL AUTO_INCREMENT,
        client_id VARCHAR(255) DEFAULT NULL,
        post_id VARCHAR(255) DEFAULT NULL,
        project_urls VARCHAR(255) DEFAULT NULL,
        project_details VARCHAR(255) DEFAULT NULL,
        project_status VARCHAR(255) DEFAULT NULL,
        project_versions VARCHAR(255) DEFAULT NULL,
        design VARCHAR(255) DEFAULT NULL,
        design_check_list VARCHAR(255) DEFAULT NULL,
        colors VARCHAR(255) DEFAULT NULL,
        development VARCHAR(255) DEFAULT NULL,
        development_check_list VARCHAR(255) DEFAULT NULL,
        git_repo VARCHAR(255) DEFAULT NULL,
        delivery VARCHAR(255) DEFAULT NULL,
        delivery_check_list VARCHAR(255) DEFAULT NULL,
        project_team VARCHAR(255) DEFAULT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY post_id (post_id)
    ) $charset_collate;";

        dbDelta($sql);
    }

    function create_onboarding_table()
    {
        $charset_collate = $this->wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$this->project_onboarding_table} (
            id INT NOT NULL AUTO_INCREMENT,
            created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            post_id INTEGER DEFAULT NULL,
            client_id VARCHAR(255) DEFAULT NULL,
            deadline VARCHAR(255) DEFAULT NULL,
            deadline_date VARCHAR(255) DEFAULT NULL,
            where_business VARCHAR(255) DEFAULT NULL,
            website VARCHAR(255) DEFAULT NULL,
            website_url VARCHAR(255) DEFAULT NULL,
            hosting VARCHAR(255) DEFAULT NULL,
            satisfied VARCHAR(255) DEFAULT NULL,
            signage VARCHAR(255) DEFAULT NULL,
            signage_url VARCHAR(255) DEFAULT NULL,
            social VARCHAR(255) DEFAULT NULL,
            social_facebook VARCHAR(255) DEFAULT NULL,
            social_x VARCHAR(255) DEFAULT NULL,
            social_linkedin VARCHAR(255) DEFAULT NULL,
            social_instagram VARCHAR(255) DEFAULT NULL,
            logo VARCHAR(255) DEFAULT NULL,
            logo_url VARCHAR(255) DEFAULT NULL,
            colors VARCHAR(255) DEFAULT NULL,
            colors_primary VARCHAR(255) DEFAULT NULL,
            colors_secondary VARCHAR(255) DEFAULT NULL,
            colors_tertiary VARCHAR(255) DEFAULT NULL,
            summary VARCHAR(255) DEFAULT NULL,
            summary_url VARCHAR(255) DEFAULT NULL,
            plan VARCHAR(255) DEFAULT NULL,
            plan_url VARCHAR(255) DEFAULT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        dbDelta($sql);
    }

    function create_problem_table()
    {
        $charset_collate = $this->wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$this->project_problem_table} (
            id INT NOT NULL AUTO_INCREMENT,
            created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            post_id VARCHAR(255) DEFAULT NULL,
            client_id VARCHAR(255) DEFAULT NULL,
            customers_impacted VARCHAR(255) DEFAULT NULL,
            problem_affected VARCHAR(255) DEFAULT NULL,
            challenges VARCHAR(255) DEFAULT NULL,
            affected_operations VARCHAR(255) DEFAULT NULL,
            change_event VARCHAR(255) DEFAULT NULL,
            factors_contributed VARCHAR(255) DEFAULT NULL,
            patterns_trends VARCHAR(255) DEFAULT NULL,
            first_notice_date VARCHAR(255) DEFAULT NULL,
            recurring_issue VARCHAR(255) DEFAULT NULL,
            tried_solutions VARCHAR(255) DEFAULT NULL,
            tried_solutions_results VARCHAR(255) DEFAULT NULL,
            ideal_resolution VARCHAR(255) DEFAULT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        dbDelta($sql);
    }
}
