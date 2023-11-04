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
    private $project_status;

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

        $this->project_status = 0;
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
                $this->project_status = $this->portfolio_project->getProjectStatus($post_id);
            }
        }
    }

    function getProjectURLsList()
    {
        if (is_array($_REQUEST['project_urls_list']) && count($_REQUEST['project_urls_list']) > 0) {
            $project_urls_list = $_REQUEST['project_urls_list'];
            $projecturlslist = [];

            foreach ($project_urls_list as $i => $project_url) {
                if (isset($project_url['name']) && isset($project_url['url'])) {
                    $projectURLsObject = [
                        'name' => $project_url['name'],
                        'icon' => $project_url['icon'],
                        'url' => $project_url['url']
                    ];

                    $projecturlslist[] = $projectURLsObject;
                }
            }

            return $projecturlslist;
        } else {
            return [];
        }
    }

    function getProjectDetailsList()
    {
        if (isset($_REQUEST['project_details_list']) && count($_REQUEST['project_details_list']) > 0) {
            $project_details_list = $_REQUEST['project_details_list'];

            $projectdetailslist = [
                'client_name' => $project_details_list['client_name'],
                'start_date' => $project_details_list['start_date'],
                'end_date' => $project_details_list['end_date']
            ];

            return $projectdetailslist;
        } else {
            return [];
        }
    }

    function getProjectVersionsList()
    {
        if (isset($_REQUEST['project_versions_list']) && count($_REQUEST['project_versions_list']) > 0) {
            $project_versions_list = $_REQUEST['project_versions_list'];

            foreach ($project_versions_list as $i => $project_version) {
                if (isset($project_version['title']) && isset($project_version['version'])) {
                    $projectVersionsObject = [
                        'title' => $project_version['title'],
                        'version' => $project_version['version']
                    ];

                    $project_versions[] = $projectVersionsObject;
                }
            }

            $projectversionslist[] = [
                'current_version' => $project_versions_list['current_version'],
                is_array($project_versions) ? $project_versions : ''
            ];

            return $projectversionslist;
        } else {
            return [];
        }
    }

    function getDesignCheckList()
    {
        if (is_array($_REQUEST['design_check_list']) && count($_REQUEST['design_check_list']) > 0) {
            $design_check_list = $_REQUEST['design_check_list'];
            $checklist = [];

            foreach ($design_check_list as $i => $task) {
                if (isset($task['name']) && isset($task['time'])) {
                    $taskObject = [
                        'status' => isset($task['status']) ? $task['status'] : '',
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

    function getColorsList()
    {
        if (is_array($_REQUEST['colors_list']) && count($_REQUEST['colors_list']) > 0) {
            $colors_list = $_REQUEST['colors_list'];
            $colorslist = [];

            foreach ($colors_list as $i => $color) {
                if (isset($color['title']) && isset($color['color'])) {
                    $colorObject = [
                        'title' => $color['title'],
                        'color' => $color['color'],
                    ];

                    $colorslist[] = $colorObject;
                }
            }

            return $colorslist;
        } else {
            return [];
        }
    }

    function getDevelopmentCheckList()
    {
        if (is_array($_REQUEST['development_check_list']) && count($_REQUEST['development_check_list']) > 0) {
            $development_check_list = $_REQUEST['development_check_list'];
            $checklist = [];

            foreach ($development_check_list as $i => $task) {
                if (isset($task['name']) && isset($task['time'])) {
                    $taskObject = [
                        'status' => isset($task['status']) ? $task['status'] : '',
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

            foreach ($delivery_check_list as $i => $task) {
                if (isset($task['name']) && isset($task['time'])) {
                    $taskObject = [
                        'status' => isset($task['status']) ? $task['status'] : '',
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
        <div class="project-urls-list" id="project_urls_list">
            <?php
            $project_urls_list = $this->project['project_urls_list'];

            if (is_array($project_urls_list)) {
                foreach ($project_urls_list as $i => $project_url) {
            ?>
                    <div class="project-url" id="project_url">
                        <input type="text" name="project_urls_list[<?php echo $i; ?>][name]" value="<?php echo esc_attr($project_url['name']); ?>" placeholder="URL Name" />
                        <input type="text" name="project_urls_list[<?php echo $i; ?>][icon]" value="<?php echo esc_attr($project_url['icon']); ?>" placeholder="URL Icon" />
                        <input type='url' name="project_urls_list[<?php echo $i; ?>][url]" value="<?php echo esc_attr($project_url['url']); ?>" placeholder="URL" />
                    </div>
            <?php }
            } ?>
        </div>
        <button id="add_project_url_button">Add URL</button>
    <?php }

    function project_details()
    {
        $project_details_list = $this->project['project_details_list'];
        $client_name = isset($project_details_list['client_name']) ? $this->project['project_details_list']['client_name'] : '';
        $start_date = isset($project_details_list['start_date']) ? $this->project['project_details_list']['start_date'] : '';
        $end_date = isset($project_details_list['end_date']) ? $this->project['project_details_list']['end_date'] : '';
    ?>
        <div class="project-details-list" id="project_details_list">

            <div class="project-details" id="project_details">
                <input type="text" name="project_details_list[client_name]" value="<?php echo esc_attr($client_name); ?>" placeholder="Client Name">
                <input type="date" name="project_details_list[start_date]" value="<?php echo esc_attr($start_date); ?>" placeholder="Start Date">
                <input type='date' name="project_details_list[end_date]" value="<?php echo esc_attr($end_date); ?>" placeholder="End Date" />
            </div>
        </div>
    <?php }

    function project_status()
    { ?>
        <div>
            <h2><?php echo esc_attr($this->project_status); ?></h2>
        </div>
    <?php
    }

    // This is an array
    function project_versions()
    {
        $current_version = isset($this->project['project_versions_list']['current_version']) ? $this->project['project_versions_list']['current_version'] : '';
    ?>
        <div class="project-versions-list" id="project_versions_list">
            <div class="version">
                <label for="current_version">Current Version:</label>
                <input type="text" id="current_version" name="project_versions_list[current_version]" value="<?php echo esc_attr($current_version); ?>" placeholder="Current Version Number">
            </div>
            <?php
            $project_versions_list = $this->project['project_versions_list'];

            if (is_array($project_versions_list)) {
                foreach ($project_versions_list as $i => $version) {
                    $title = isset($version['title']) ? esc_attr($version['title']) : '';
                    $versionNumber = isset($version['version']) ? esc_attr($version['version']) : '';
            ?>
                    <div class="version">
                        <input type="text" name="project_versions_list[<?php echo $i; ?>][title]" value="<?php echo $title; ?>" placeholder="Version title">
                        <input type="text" name="project_versions_list[<?php echo $i; ?>][version]" value="<?php echo $versionNumber; ?>" placeholder="Version number">
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <button id="add_version_button">Add Version</button>
    <?php
    }

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

    function colors()
    { ?>
        <div class="colors-list" id="colors_list">
            <?php
            $colors_list = $this->project['colors_list'];

            if (is_array($colors_list)) {
                foreach ($colors_list as $i => $color) {
            ?>
                    <div class="color" id="color">
                        <input type="text" name="colors_list[<?php echo $i; ?>][title]" value="<?php echo esc_attr($color['title']); ?>" placeholder="Color title">
                        <input type='color' name="colors_list[<?php echo $i; ?>][color]" value="<?php echo esc_attr($color['color']); ?>" placeholder="Color" />
                    </div>
            <?php }
            } ?>
        </div>
        <button id="add_color_button">Add Color</button>
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

        $project_urls_list = [];
        $project_details_list = [];
        $project_versions_list = [];
        $design_check_list = [];
        $colors_list = [];
        $development_check_list = [];
        $delivery_check_list = [];

        if (isset($_REQUEST['project_urls_list'])) {
            $project_urls_list = $this->getProjectURLsList();
        }

        if (isset($_REQUEST['project_details_list'])) {
            $project_details_list = $this->getProjectDetailsList();
        }

        if (isset($_REQUEST['project_versions_list'])) {
            $project_versions_list = $this->getProjectVersionsList();
        }

        if (isset($_REQUEST['design_check_list'])) {
            $design_check_list = $this->getDesignCheckList();
        }

        if (isset($_REQUEST['colors_list'])) {
            $colors_list = $this->getColorsList();
        }

        if (isset($_REQUEST['development_check_list'])) {
            $development_check_list = $this->getDevelopmentCheckList();
        }

        if (isset($_REQUEST['delivery_check_list'])) {
            $delivery_check_list = $this->getDeliveryCheckList();
        }

        $project = [
            'client_id' => !empty($_REQUEST['client_id']) ? sanitize_text_field($_REQUEST['client_id']) : '',
            'post_id' => $post_id,
            'project_urls_list' => $project_urls_list,
            'project_details_list' => $project_details_list,
            'project_status' => $this->project_status,
            'project_versions_list' => $project_versions_list,
            'design' => isset($_REQUEST['design']) ? sanitize_text_field($_REQUEST['design']) : '',
            'design_check_list' => $design_check_list,
            'colors_list' => $colors_list,
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
