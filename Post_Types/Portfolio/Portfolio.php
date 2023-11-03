<?php

namespace SEVEN_TECH_Portfolio\Post_Types\Portfolio;

use Exception;

use SEVEN_TECH_Portfolio\Database\Database;
use SEVEN_TECH_Portfolio\Database\DatabaseProject;
use SEVEN_TECH_Portfolio\Post_Types\Portfolio\PortfolioProject;

class Portfolio
{
    private $project_database;
    private $portfolio_project;
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
        $this->portfolio_project = new PortfolioProject;

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
                "priority" => "low"
            ],
            [
                "name" => "Project Details",
                "alias" => "project_details",
                "position" => "normal",
                "priority" => "low"
            ],
            [
                "name" => "Project Status",
                "alias" => "project_status",
                "position" => "side",
                "priority" => "high"
            ],
            [
                "name" => "Project Versions",
                "alias" => "project_versions",
                "position" => "normal",
                "priority" => "low"
            ],
            [
                "name" => "Design",
                "alias" => "design",
                "position" => "normal",
                "priority" => "low"
            ],
            [
                "name" => "Design Check List",
                "alias" => "design_check_list",
                "position" => "normal",
                "priority" => "high"
            ],
            [
                "name" => "Colors",
                "alias" => "colors",
                "position" => "normal",
                "priority" => "low"
            ],
            [
                "name" => "Development",
                "alias" => "development",
                "position" => "normal",
                "priority" => "low"
            ],
            [
                "name" => "Development Check List",
                "alias" => "development_check_list",
                "position" => "normal",
                "priority" => "high"
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
                "position" => "normal",
                "priority" => "low"
            ],
            [
                "name" => "Delivery Check List",
                "alias" => "delivery_check_list",
                "position" => "normal",
                "priority" => "high"
            ],
            [
                "name" => "Project Team",
                "alias" => "project_team",
                "position" => "normal",
                "priority" => "low"
            ]
        ];
        $this->post_type = 'portfolio';

        add_action('load-post.php', [$this, 'get_project']);
        // add_action('load-post-new.php', [$this, 'get_project']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_jquery']);
        add_action('admin_enqueue_scripts', [$this, 'add_custom_js']);

        $this->design_total_hours = 20;
        $this->development_total_hours = 60;
        $this->delivery_total_hours = 10;
    }

    function add_custom_meta_boxes()
    {
        if (is_array($this->inputs)) {
            foreach ($this->inputs as $input) {
                add_meta_box(
                    $input['alias'],
                    $input['name'],
                    [$this, $input['alias']],
                    $this->post_type,
                    $input['position'],
                    $input['priority']
                );
            }
        }
    }

    function enqueue_jquery()
    {
        wp_enqueue_script('jquery');
    }

    function add_custom_js()
    {
        wp_enqueue_script('custom-js', SEVEN_TECH_PORTFOLIO_URL . 'Post_Types/Portfolio/Portfolio.js', array('jquery'), '1.0', true);
    }

    function get_project()
    {
        add_action('save_post', [$this, 'save_post_project_button'], 10, 2);

        add_action('add_meta_boxes', [$this, 'add_custom_meta_boxes']);

        if (isset($_GET['post'])) {
            $post_id = absint($_GET['post']);

            if ($post_id) {
                $this->project = $this->portfolio_project->getProject($post_id);
                return $this->project;
            }
        }
    }

    function getDesignCheckList()
    {
        if (is_array($_REQUEST['design_check_list']) && count($_REQUEST['design_check_list']) > 0) {
            $design_check_list = $_REQUEST['design_check_list'];
            $checklist = [];

            foreach ($design_check_list as $task) {
                if (isset($task['status']) && isset($task['name']) && isset($task['time'])) {
                    $taskObject = [
                        'status' => $task['status'],
                        'name' => $task['name'],
                        'time' => $task['time'],
                    ];

                    $checklist[] = $taskObject;
                }
            }

            return $checklist;
        } else {
            return [];
        }
    }


    function getDevelopmentCheckList()
    {
        if (is_array($_REQUEST['development_check_list']) && count($_REQUEST['development_check_list']) > 0) {
            $development_check_list = $_REQUEST['development_check_list'];
            $checklist = [];

            foreach ($development_check_list as $task) {
                if (isset($task['status']) && isset($task['name']) && isset($task['time'])) {
                    $taskObject = [
                        'status' => $task['status'],
                        'name' => $task['name'],
                        'time' => $task['time'],
                    ];

                    $checklist[] = $taskObject;
                }
            }

            return $checklist;
        } else {
            return [];
        }
    }

    function getDeliveryCheckList()
    {
        if (is_array($_REQUEST['delivery_check_list']) && count($_REQUEST['delivery_check_list']) > 0) {
            $delivery_check_list = $_REQUEST['delivery_check_list'];
            $checklist = [];

            foreach ($delivery_check_list as $task) {
                if (isset($task['status']) && isset($task['name']) && isset($task['time'])) {
                    $taskObject = [
                        'status' => $task['status'],
                        'name' => $task['name'],
                        'time' => $task['time'],
                    ];

                    $checklist[] = $taskObject;
                }
            }

            return $checklist;
        } else {
            return [];
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

    function design_check_list()
    { ?>
        <div class="task-list" id="design_task_list">
            <?php
            $design_check_list = $this->project['design_check_list'];

            if (is_array($design_check_list)) {
                foreach ($design_check_list as $i => $task) {
            ?>
                    <div class="task" id="design_task">
                        <input type="checkbox" name="design_check_list[<?php echo $i; ?>][status]" value="checked" <?php checked($task['status'], 'checked'); ?> />
                        <input type="text" name="design_check_list[<?php echo $i; ?>][name]" value="<?php echo esc_attr($task['name']); ?>" placeholder="Task Name" />
                        <input type="text" name="design_check_list[<?php echo $i; ?>][time]" value="<?php echo esc_attr($task['time']); ?>" placeholder="Time" />
                    </div>
            <?php }
            } ?>
        </div>
        <button id="add_design_task_button">Add Task</button>
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

    function development_check_list()
    { ?>
        <div class="task-list" id="development_task_list">
            <?php
            $development_check_list = $this->project['development_check_list'];

            if (is_array($development_check_list)) {
                foreach ($development_check_list as $i => $task) {
            ?>
                    <div class="task" id="development_task">
                        <input type="checkbox" name="development_check_list[<?php echo $i; ?>][status]" value="checked" <?php checked($task['status'], 'checked'); ?> />
                        <input type="text" name="development_check_list[<?php echo $i; ?>][name]" value="<?php echo esc_attr($task['name']); ?>" placeholder="Task Name" />
                        <input type="text" name="development_check_list[<?php echo $i; ?>][time]" value="<?php echo esc_attr($task['time']); ?>" placeholder="Time" />
                    </div>
            <?php }
            } ?>
        </div>
        <button id="add_development_task_button">Add Task</button>
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

    function delivery_check_list()
    { ?>
        <div class="task-list" id="delivery_task_list">
            <?php
            $delivery_check_list = $this->project['delivery_check_list'];

            if (is_array($delivery_check_list)) {
                foreach ($delivery_check_list as $i => $task) {
            ?>
                    <div class="task" id="delivery_task">
                        <input type="checkbox" name="delivery_check_list[<?php echo $i; ?>][status]" value="checked" <?php checked($task['status'], 'checked'); ?> />
                        <input type="text" name="delivery_check_list[<?php echo $i; ?>][name]" value="<?php echo esc_attr($task['name']); ?>" placeholder="Task Name" />
                        <input type="text" name="delivery_check_list[<?php echo $i; ?>][time]" value="<?php echo esc_attr($task['time']); ?>" placeholder="Time" />
                    </div>
            <?php }
            } ?>
        </div>
        <button id="add_delivery_task_button">Add Task</button>
    <?php }

    function project_team()
    { ?>
        <input type='text' name="project_team" value="" />
<?php }

    function save_post_project_button($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        $design_check_list = [];
        $development_check_list = [];
        $delivery_check_list = [];

        // Check if design checklist exists in $_REQUEST and retrieve it
        if (isset($_REQUEST['design_check_list'])) {
            $design_check_list = $this->getDesignCheckList();
        }

        // Check if development checklist exists in $_REQUEST and retrieve it
        if (isset($_REQUEST['development_check_list'])) {
            $development_check_list = $this->getDevelopmentCheckList();
        }

        // Check if delivery checklist exists in $_REQUEST and retrieve it
        if (isset($_REQUEST['delivery_check_list'])) {
            $delivery_check_list = $this->getDeliveryCheckList();
        }

        // Build the project data array
        $project = [
            'client_id' => !empty($_REQUEST['client_id']) ? sanitize_text_field($_REQUEST['client_id']) : '',
            'post_id' => $post_id,
            'project_urls' => isset($_REQUEST['project_urls']) ? sanitize_text_field($_REQUEST['project_urls']) : '',
            'project_details' => isset($_REQUEST['project_details']) ? sanitize_text_field($_REQUEST['project_details']) : '',
            'project_status' => isset($_REQUEST['project_status']) ? sanitize_text_field($_REQUEST['project_status']) : '',
            'project_versions' => isset($_REQUEST['project_versions']) ? sanitize_text_field($_REQUEST['project_versions']) : '',
            'design' => isset($_REQUEST['design']) ? sanitize_text_field($_REQUEST['design']) : '',
            'design_check_list' => $design_check_list,
            'colors' => isset($_REQUEST['colors']) ? sanitize_text_field($_REQUEST['colors']) : '',
            'development' => isset($_REQUEST['development']) ? sanitize_text_field($_REQUEST['development']) : '',
            'development_check_list' => $development_check_list,
            'git_repo' => isset($_REQUEST['git_repo']) ? sanitize_text_field($_REQUEST['git_repo']) : '',
            'delivery' => isset($_REQUEST['delivery']) ? sanitize_text_field($_REQUEST['delivery']) : '',
            'delivery_check_list' => $delivery_check_list,
            'project_team' => isset($_REQUEST['project_team']) ? sanitize_text_field($_REQUEST['project_team']) : '',
        ];

        $existing_project = $this->project_database->getProject($post_id);

        if (is_array($existing_project)) {
            return $this->project_database->updateProject($post_id, $project);
        } else {
            return $this->project_database->saveProject($project);
        }
    }
}
