<?php

namespace SEVEN_TECH\Portfolio\Database;

use PDO;
use PDOException;

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

class Database
{
    private $wpdb;
    private $db_type;
    private $db_host;
    protected $db_name;
    private $db_user;
    private $db_password;
    protected $connection;
    public $db_charset;
    public $db_collate;
    public $charset_collate;
    private $updated_at;
    private $standard_conforming_strings;
    private $encoding;
    private $dsn;

    public function __construct()
    {
        try {
            global $wpdb;
            $this->wpdb = $wpdb;

            $this->updated_at = ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP';
            $this->db_charset = $wpdb->charset;
            $this->db_collate = $wpdb->collate;
            $this->charset_collate = $wpdb->get_charset_collate();
            $this->standard_conforming_strings = 'ON';
            $this->encoding = 'UTF8';

            if (!isset($_ENV['DB_TYPE']) || $_ENV['DB_TYPE'] == null || !isset($_ENV['DB_HOST']) ||  $_ENV['DB_HOST'] == null || !isset($_ENV['DB_USER']) || $_ENV['DB_USER'] == null || !isset($_ENV['DB_PASSWORD']) || $_ENV['DB_PASSWORD'] == null) {
                $this->db_type = 'mysql';
                $this->db_host = $wpdb->dbhost;
                $this->db_user = $wpdb->dbuser;
                $this->db_password = $wpdb->dbpassword;
                $this->db_name = get_option('DB_NAME', 'seven_tech');

                $this->dsn = "mysql:host=$this->db_host;dbname=$this->db_name;charset=$this->db_charset";
                $this->connection = new PDO($this->dsn, $this->db_user, $this->db_password);
            }

            if (isset($_ENV['DB_TYPE']) && $_ENV['DB_TYPE'] != null || isset($_ENV['DB_HOST']) &&  $_ENV['DB_HOST'] != null || isset($_ENV['DB_USER']) && $_ENV['DB_USER'] != null || isset($_ENV['DB_PASSWORD']) && $_ENV['DB_PASSWORD'] != null) {
                $this->db_type = $_ENV['DB_TYPE'];
                $this->db_host = $_ENV['DB_HOST'];
                $this->db_user = $_ENV['DB_USER'];
                $this->db_password = $_ENV['DB_PASSWORD'];
                $this->db_name = $_ENV['DB_NAME'] ?: 'orb';


                if ($this->db_type == 'mysql') {
                    $this->dsn = "mysql:host=$this->db_host;dbname=$this->db_name;charset=$this->db_charset";
                    $this->connection = new PDO($this->dsn, $this->db_user, $this->db_password);
                }

                if ($this->db_type == 'pgsql') {
                    $this->dsn = "pgsql:host=$this->db_host;";
                    $this->connection = new PDO($this->dsn, $this->db_user, $this->db_password);
                    $this->updated_at = '';
                    $this->charset_collate = '';
                }
            }

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log("Connection failed: " . $e->getMessage());
            $this->establishConnection();
        }
    }

    public function getDBName()
    {
        return $this->db_name;
    }

    public function  getConnection()
    {
        return $this->connection;
    }

    public function establishConnection()
    {
        error_log($this->db_name);

        if ($this->db_type == 'mysql') {
            $this->createMySQLDatabase();
        } elseif ($this->db_type == 'pgsql') {
            $this->createPostgreSQLDatabase();
        }
    }

    private function createMySQLDatabase()
    {
        try {
            $dsn = "mysql:host=$this->db_host;";
            $connection = new PDO($dsn, $this->db_user, $this->db_password);
            $checkDatabaseExists = $connection->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = :dbname");
            $checkDatabaseExists->execute([':dbname' => $this->db_name]);

            if (empty($checkDatabaseExists->rowCount())) {
                $connection->exec("CREATE DATABASE IF NOT EXISTS {$this->db_name} CHARACTER SET {$this->wpdb->charset} COLLATE {$this->wpdb->collate}");
            }

            return $this->createTables();
        } catch (PDOException $e) {
            error_log("Connection failed: " . $e->getMessage());
        }
    }

    private function createPostgreSQLDatabase()
    {
        $dsn = "pgsql:host={$this->db_host};";
        $connection = new PDO($dsn, $this->db_user, $this->db_password);
        $checkDatabaseExists = $connection->prepare("SELECT datname FROM pg_database WHERE datname = :dbname");
        $checkDatabaseExists->execute([':dbname' => $this->db_name]);

        if (empty($checkDatabaseExists->rowCount())) {
            $connection->exec("CREATE DATABASE {$this->db_name}");
        }

        return $this->createTables();
    }

    function updatedAT($table_name)
    {
        if ($this->db_type === 'pgsql') {
            $setEncoding = "SET CLIENT_ENCODING TO {$this->encoding}";

            $this->connection->query($setEncoding);

            $standardConformingStrings = "SET STANDARD_CONFORMING_STRINGS TO {$this->standard_conforming_strings};";

            $this->connection->query($standardConformingStrings);

            $triggerSql = "
                CREATE OR REPLACE FUNCTION update_timestamp()
                RETURNS TRIGGER AS $$
                BEGIN
                    NEW.updated_at = CURRENT_TIMESTAMP;
                    RETURN NEW;
                END;
                $$ LANGUAGE plpgsql;
    
                DROP TRIGGER IF EXISTS update_timestamp ON {$table_name};
                CREATE TRIGGER update_timestamp
                BEFORE UPDATE ON {$table_name}
                FOR EACH ROW
                EXECUTE FUNCTION update_timestamp();
            ";

            $this->connection->exec($triggerSql);
        }
    }

    function createTables()
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        $this->create_portfolio_table();
        $this->create_project_onboarding_table();
        $this->create_project_problem_table();
    }

    function create_portfolio_table()
    {
        try {
            $table_name = 'portfolio';

            $sql = "CREATE TABLE {$table_name} (
                id INT NOT NULL AUTO_INCREMENT,
                created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                project_id VARCHAR(255) DEFAULT NULL,
                price VARCHAR(255) DEFAULT NULL,
                features VARCHAR(255) DEFAULT NULL,
                action_word VARCHAR(255) DEFAULT NULL,
                project_title VARCHAR(255) DEFAULT NULL,
                project_slug VARCHAR(255) DEFAULT NULL,
                client_id VARCHAR(255) DEFAULT NULL,
                project_urls_list TEXT DEFAULT NULL,
                project_details_list TEXT DEFAULT NULL,
                project_status VARCHAR(255) DEFAULT NULL,
                project_versions_list TEXT DEFAULT NULL,
                design VARCHAR(255) DEFAULT NULL,
                design_check_list TEXT DEFAULT NULL,
                colors_list TEXT DEFAULT NULL,
                development VARCHAR(255) DEFAULT NULL,
                development_check_list TEXT DEFAULT NULL,
                git_repo VARCHAR(255) DEFAULT NULL,
                delivery VARCHAR(255) DEFAULT NULL,
                delivery_check_list TEXT DEFAULT NULL,
                project_team_list TEXT DEFAULT NULL,
                PRIMARY KEY (id),
                UNIQUE KEY project_id (project_id)
            ) {$this->charset_collate};";

            $this->connection->query($sql);
            $this->updatedAT($table_name);
        } catch (PDOException $e) {
            error_log("Error creating options table: " . $e->getMessage());
        }
    }

    function create_project_onboarding_table()
    {
        try {
            $table_name = 'project_onboarding';

            $sql = "CREATE TABLE {$table_name} (
                id INT NOT NULL AUTO_INCREMENT,
                created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                project_id VARCHAR(255) DEFAULT NULL,
                project_title VARCHAR(255) DEFAULT NULL,
                project_slug VARCHAR(255) DEFAULT NULL,
                client_id VARCHAR(255) DEFAULT NULL,
                deadline VARCHAR(255) DEFAULT NULL,
                where_business VARCHAR(255) DEFAULT NULL,
                website VARCHAR(255) DEFAULT NULL,
                hosting VARCHAR(255) DEFAULT NULL,
                satisfied VARCHAR(255) DEFAULT NULL,
                signage VARCHAR(255) DEFAULT NULL,
                social_networks TEXT DEFAULT NULL,
                logo VARCHAR(255) DEFAULT NULL,
                colors TEXT DEFAULT NULL,
                plan VARCHAR(255) DEFAULT NULL,
                PRIMARY KEY (id),
                UNIQUE KEY project_id (project_id)
            ) {$this->charset_collate};";

            $this->connection->query($sql);
            $this->updatedAT($table_name);
        } catch (PDOException $e) {
            error_log("Error creating options table: " . $e->getMessage());
        }
    }

    function create_project_problem_table()
    {
        try {
            $table_name = 'project_problem';

            $sql = "CREATE TABLE {$table_name} (
                id INT NOT NULL AUTO_INCREMENT,
                created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                project_id VARCHAR(255) DEFAULT NULL,
                project_title VARCHAR(255) DEFAULT NULL,
                project_slug VARCHAR(255) DEFAULT NULL,
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
                PRIMARY KEY (id),
                UNIQUE KEY project_id (project_id)
            ) {$this->charset_collate};";

            $this->connection->query($sql);
            $this->updatedAT($table_name);
        } catch (PDOException $e) {
            error_log("Error creating options table: " . $e->getMessage());
        }
    }
}
