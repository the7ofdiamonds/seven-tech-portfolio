<?php

namespace THFW_Portfolio\Database;

use THFW_Portfolio\Database\OnboardingDatabase;
use THFW_Portfolio\Database\TheProblemDatabase;

class Database
{
    private $wpdb;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;

        $this->createTables();

        new OnboardingDatabase;
        new TheProblemDatabase;
    }

    function createTables()
    {
        $this->create_onboarding_table();
        $this->create_problem_table();
    }

    function create_onboarding_table()
    {
        $table_name = '7tech_onboarding';
        $charset_collate = $this->wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$table_name} (
            id INT NOT NULL AUTO_INCREMENT,
            created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
        $table_name = '7tech_problem';
        $charset_collate = $this->wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$table_name} (
            id INT NOT NULL AUTO_INCREMENT,
            created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            client_id VARCHAR(255) DEFAULT NULL,
            customers_impacted VARCHAR(255) DEFAULT NULL,
            primary_stackholders VARCHAR(255) DEFAULT NULL,
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
