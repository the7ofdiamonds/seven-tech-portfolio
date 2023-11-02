<?php

namespace SEVEN_TECH_Portfolio\Post_Types\Portfolio;

use SEVEN_TECH_Portfolio\Database\Database;
use SEVEN_TECH_Portfolio\Database\DatabaseProject;

class Portfolio
{
    private $project_database;
    private $inputs;
    private $post_type;
    private $project;
    private $design_total_hours;
    private $development_total_hours;
    private $delivery_total_hours;

    public function __construct()
    {
        $database = new Database;
        $this->project_database = new DatabaseProject($database->project_table);

        $this->inputs = [
            [
                "name" => "Client ID",
                "alias" => "client_id",
                "position" => "side",
                "priority" => "low"
            ],
            [
                "name" => "Project URLs",
                "alias" => "project_urls",
                "position" => "normal",
                "priority" => "high"
            ],
            [
                "name" => "Project Details",
                "alias" => "project_details",
                "position" => "side",
                "priority" => "low"
            ],
            [
                "name" => "Project Status",
                "alias" => "project_status",
                "position" => "side",
                "priority" => "low"
            ],
            [
                "name" => "Project Versions",
                "alias" => "project_versions",
                "position" => "side",
                "priority" => "low"
            ],
            [
                "name" => "Design",
                "alias" => "design",
                "position" => "side",
                "priority" => "low"
            ],
            [
                "name" => "Design Check List",
                "alias" => "design_check_list",
                "position" => "side",
                "priority" => "low"
            ],
            [
                "name" => "Colors",
                "alias" => "colors",
                "position" => "side",
                "priority" => "low"
            ],
            [
                "name" => "Development",
                "alias" => "development",
                "position" => "side",
                "priority" => "low"
            ],
            [
                "name" => "Development Check List",
                "alias" => "development_check_list",
                "position" => "side",
                "priority" => "low"
            ],
            [
                "name" => "Git Repo",
                "alias" => "git_repo",
                "position" => "side",
                "priority" => "low"
            ],
            [
                "name" => "Delivery",
                "alias" => "delivery",
                "position" => "side",
                "priority" => "low"
            ],
            [
                "name" => "Delivery Check List",
                "alias" => "delivery_check_list",
                "position" => "side",
                "priority" => "low"
            ],
            [
                "name" => "Project Team",
                "alias" => "project_team",
                "position" => "side",
                "priority" => "low"
            ],
        ];
        $this->post_type = 'portfolio';

        add_action('add_meta_boxes', [$this, 'add_custom_meta_boxes']);
        add_action('save_post', [$this, 'save_post_project_button']);
        add_action('load-post.php', [$this, 'get_project']);
        // add_action('load-post-new.php', 'your_function');

        $this->design_total_hours = 20;
        $this->development_total_hours = 60;
        $this->delivery_total_hours = 10;
    }

    function add_custom_meta_boxes()
    {
        foreach ($this->inputs as $input) {
            add_meta_box(
                "post_metadata_box_" . $input['alias'],
                $input['name'],
                [$this, $input['alias']],
                $this->post_type,
                $input['position'],
                $input['priority']
            );
        }
    }

    function get_project()
    {
        if (isset($_GET['post'])) {
            $post_id = absint($_GET['post']);

            if ($post_id) {
                $project = $this->project = $this->project_database->getProject($post_id);
                return $project;
            }
        }
    }

    function save_post_project_button($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        $existing_project = $this->project_database->getProject($post_id);

        $project = [
            'client_id' => !empty($_POST['client_id']) ? sanitize_text_field($_POST['client_id']) : '',
            'post_id' => $post_id,
            'project_urls' => isset($_POST['project_urls']) ? sanitize_text_field($_POST['project_urls']) : '',
            'project_details' => isset($_POST['project_details']) ? sanitize_text_field($_POST['project_details']) : '',
            'project_status' => isset($_POST['project_status']) ? sanitize_text_field($_POST['project_status']) : '',
            'project_versions' => isset($_POST['project_versions']) ? sanitize_text_field($_POST['project_versions']) : '',
            'design' => isset($_POST['design']) ? sanitize_text_field($_POST['design']) : '',
            'design_check_list' => isset($_POST['design_check_list']) ? sanitize_text_field($_POST['design_check_list']) : '',
            'colors' => isset($_POST['colors']) ? sanitize_text_field($_POST['colors']) : '',
            'development' => isset($_POST['development']) ? sanitize_text_field($_POST['development']) : '',
            'development_check_list' => isset($_POST['development_check_list']) ? sanitize_text_field($_POST['development_check_list']) : '',
            'git_repo' => isset($_POST['git_repo']) ? sanitize_text_field($_POST['git_repo']) : '',
            'delivery' => isset($_POST['delivery']) ? sanitize_text_field($_POST['delivery']) : '',
            'delivery_check_list' => isset($_POST['delivery_check_list']) ? sanitize_text_field($_POST['delivery_check_list']) : '',
            'project_team' => isset($_POST['project_team']) ? sanitize_text_field($_POST['project_team']) : '',
        ];

        if (is_array($existing_project)) {
            return $this->project_database->updateProject($post_id, $project);
        } else {
            return $this->project_database->saveProject($project);
        }
    }

    // Project Database
    // This should be automatically added when payment is recieved.
    function client_id()
    { ?>
        <input type='text' name="client_id" value="<?php echo esc_attr($this->project['client_id']); ?>" />
    <?php }

    // This should be an array of URLs
    function project_urls()
    { ?>
        <input type='url' name="project_urls" value="<?php echo esc_attr($this->project['project_urls']); ?>" />
    <?php }

    // This should be automatically added when payment is recieved.
    function project_details()
    { ?>
        <input type='text' name="project_details" value="<?php echo esc_attr($this->project['project_details']); ?>" />
    <?php }

    // There should be a way to calculate this using the checklist
    function project_status()
    {
        $project_status = $this->project['project_status'];
        $project_status = $this->design_total_hours + $this->development_total_hours + $this->delivery_total_hours;
    ?>
        <input type='text' name="project_status" value="<?php echo esc_attr($project_status); ?>" />
    <?php }

    // This is an array
    function project_versions()
    { ?>
        <input type='text' name="project_versions" value="<?php echo esc_attr($this->project['project_versions']); ?>" />
    <?php }

    function design()
    { ?>
        <textarea name="design"><?php echo esc_textarea($this->project['design']); ?></textarea>
    <?php }

    // This creates a checklist
    function design_check_list()
    { ?>
        <!-- List should include task name, amount of time it takes to complete and its status -->
        <input type='text' name="design_check_list" value="<?php echo esc_attr($this->project['design_check_list']); ?>" />
    <?php }

    // This is a array of colors
    function colors()
    { ?>
        <input type='text' name="colors" value="<?php echo esc_attr($this->project['colors']); ?>" />
    <?php }

    function development()
    { ?>
        <textarea name="development"><?php echo esc_attr($this->project['development']); ?></textarea>
    <?php }

    // This creates a checklist
    function development_check_list()
    { ?>
        <input type='text' name="development_check_list" value="<?php echo esc_attr($this->project['development_check_list']); ?>" />
    <?php }

    // This is a link to the repository
    function git_repo()
    { ?>
        <input type='text' name="git_repo" value="<?php echo esc_attr($this->project['git_repo']); ?>" />
    <?php }

    function delivery()
    { ?>
        <textarea name="delivery"><?php echo esc_attr($this->project['delivery']); ?></textarea>
    <?php }

    // This creates a checklist
    function delivery_check_list()
    { ?>
        <input type='text' name="delivery_check_list" value="<?php echo esc_attr($this->project['delivery_check_list']); ?>" />
    <?php }

    // This is an array of users which can be chosen by role
    function project_team()
    { ?>
        <input type='text' name="project_team" value="<?php echo esc_attr($this->project['project_team']); ?>" />
<?php }
}
