<?php

namespace SEVEN_TECH\Portfolio\Database;

use Exception;

use PDO;
use PDOException;

class DatabaseProject
{
    private $wpdb;
    private $table_name;
    private $connection;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_name = 'SEVEN_TECH_Portfolio';
        $database = new Database();
        $this->connection = $database->getConnection();
    }

    function saveProject($project)
    {
        try {
            if (!is_array($project)) {
                throw new Exception('Project data is needed to save to the database.', 400);
            }

            $project_id = !empty($project['project_id']) ? $project['project_id'] : '';
            $project_title = !empty($project['project_title']) ? $project['project_title'] : '';
            $project_slug = !empty($project['project_slug']) ? $project['project_slug'] : '';
            $client_id = !empty($project['client_id']) ? $project['client_id'] : '';

            if (empty($project_id)) {
                throw new Exception('Project ID is required.', 404);
            }

            if (empty($project_title)) {
                throw new Exception('Project title is required.', 404);
            }

            if (empty($project_slug)) {
                throw new Exception('Project slug is required.', 404);
            }

            if (empty($client_id)) {
                throw new Exception('Client ID is required.', 404);
            }

            $stmt = $this->connection->prepare("CALL saveProject(:project_id, :project_title, :price, :features, :project_slug, :client_id, :project_urls_list, :project_details_list, :project_status, :project_versions_list, :design, :design_check_list, :colors_list, :development, :development_check_list, :git_repo, :delivery, :delivery_check_list, :project_team_list, :icon, :button_icon, :action_word)");

            $stmt->bindParam(':project_id', $project_id);
            $stmt->bindParam(':project_title', $project_title);
            $stmt->bindParam(':price', !empty($project['price']) ? serialize($project['price']) : '');
            $stmt->bindParam(':features', !empty($project['features']) ? serialize($project['features']) : '');
            $stmt->bindParam(':project_slug', $project_slug);
            $stmt->bindParam(':client_id', $client_id);
            $stmt->bindParam(':project_urls_list', !empty($project['project_urls_list']) ? serialize($project['project_urls_list']) : '');
            $stmt->bindParam(':project_details_list', !empty($project['project_details_list']) ? serialize($project['project_details_list']) : '');
            $stmt->bindParam(':project_status', !empty($project['project_status']) ? $project['project_status'] : '');
            $stmt->bindParam(':project_versions_list', !empty($project['project_versions_list']) ? serialize($project['project_versions_list']) : '');
            $stmt->bindParam(':design', !empty($project['design']) ? $project['design'] : '');
            $stmt->bindParam(':design_check_list', !empty($project['design_check_list']) ? serialize($project['design_check_list']) : '');
            $stmt->bindParam(':colors_list', !empty($project['colors_list']) ? serialize($project['colors_list']) : '');
            $stmt->bindParam(':development', !empty($project['development']) ? $project['development'] : '');
            $stmt->bindParam(':development_check_list', !empty($project['development_check_list']) ? serialize($project['development_check_list']) : '');
            $stmt->bindParam(':git_repo', !empty($project['git_repo']) ? $project['git_repo'] : '');
            $stmt->bindParam(':delivery', !empty($project['delivery']) ? $project['delivery'] : '');
            $stmt->bindParam(':delivery_check_list', !empty($project['delivery_check_list']) ? serialize($project['delivery_check_list']) : '');
            $stmt->bindParam(':project_team_list', !empty($project['project_team_list']) ? serialize($project['project_team_list']) : '');
            $stmt->bindParam(':icon', !empty($project['icon']) ? serialize($project['icon']) : '');
            $stmt->bindParam(':button_icon', !empty($project['button_icon']) ? serialize($project['button_icon']) : '');
            $stmt->bindParam(':action_word', !empty($project['action_word']) ? serialize($project['action_word']) : '');

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at saveProject');

            return $response;
        }
    }

    function getProject($project_id)
    {
        try {
            if (empty($project_id)) {
                throw new Exception('Project ID is required.', 400);
            }

            $stmt = $this->connection->prepare("CALL getProject(?)");

            $stmt->bindParam(1, $project_id, PDO::PARAM_INT);
            $stmt->execute();

            $project = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($project === false) {
                return '';
            }

            $project_data = [
                'id' => $project['id'],
                'price' => $project['price'],
                'project_id' => $project['project_id'],
                'project_title' => $project['project_title'],
                'project_slug' => $project['project_slug'],
                'client_id' => $project['client_id'],
                'project_urls_list' => $project['project_urls_list'],
                'project_details_list' => $project['project_details_list'],
                'project_status' => $project['project_status'],
                'project_versions_list' => $project['project_versions_list'],
                'design' => $project['design'],
                'design_check_list' => $project['design_check_list'],
                'colors_list' => $project['colors_list'],
                'development' => $project['development'],
                'development_check_list' => $project['development_check_list'],
                'git_repo' => $project['git_repo'],
                'delivery' => $project['delivery'],
                'delivery_check_list' => $project['delivery_check_list'],
                'project_team_list' => $project['project_team_list'],
            ];

            return $project_data;
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            return $response;
        }
    }

    function getProjectByClientID($project_id, $client_id)
    {
        try {
            if (empty($project_id)) {
                throw new Exception('Project ID is required.', 400);
            }

            if (empty($client_id)) {
                throw new Exception('Client ID is required.', 400);
            }

            $project = $this->wpdb->get_row(
                $this->wpdb->prepare(
                    "SELECT * FROM {$this->table_name} WHERE project_id = %d AND client_id = %d",
                    $project_id,
                    $client_id
                )
            );

            if (!is_object($project)) {
                return ['message' => 'Project could not be found'];
            }

            $project_data = [
                'id' => $project->id,
                'price' => $project->price,
                'project_id' => $project->project_id,
                'project_title' => $project->project_title,
                'project_slug' => $project->project_slug,
                'client_id' => $project->client_id,
                'project_urls_list' => $project->project_urls,
                'project_details_list' => $project->project_details,
                'project_status' => $project->project_status,
                'project_versions_list' => $project->project_versions,
                'design' => $project->design,
                'design_check_list' => $project->design_check_list,
                'colors_list' => $project->colors,
                'development' => $project->development,
                'development_check_list' => $project->development_check_list,
                'git_repo' => $project->git_repo,
                'delivery' => $project->delivery,
                'delivery_check_list' => $project->delivery_check_list,
                'project_team_list' => $project->project_team_list,
            ];

            return $project_data;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function updateProject($project_id, $project)
    {
        try {
            if (empty($project_id)) {
                throw new Exception('Project ID is required.', 400);
            }

            if (!is_array($project)) {
                throw new Exception('Invalid Project Data', 400);
            }

            $project_title = $project['project_title'];

            $data = array(
                'price' => $project['price'],
                'project_title' => $project_title,
                'project_slug' => $project['project_slug'],
                'project_urls_list' => serialize($project['project_urls_list']),
                'project_details_list' => serialize($project['project_details_list']),
                'project_status' => $project['project_status'],
                'project_versions_list' => serialize($project['project_versions_list']),
                'design' => $project['design'],
                'design_check_list' => serialize($project['design_check_list']),
                'colors_list' => serialize($project['colors_list']),
                'development' => $project['development'],
                'development_check_list' => serialize($project['development_check_list']),
                'git_repo' => $project['git_repo'],
                'delivery' => $project['delivery'],
                'delivery_check_list' => serialize($project['delivery_check_list']),
                'project_team_list' => serialize($project['project_team_list']),
            );

            $where = array(
                'project_id' => $project_id,
            );

            $data = array_filter($data, function ($value) {
                return $value !== null;
            });

            $updated_rows = $this->wpdb->update($this->table_name, $data, $where);

            if ($updated_rows == 0) {
                throw new Exception('Failed to update project data : ' . $this->wpdb->last_error);
            }

            return [
                'project_slug' => $project['project_slug'],
                'results' => $updated_rows,
                'message' => 'Project updated successfully'
            ];
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at updateProject');

            return $response;
        }
    }
}
