<?php

namespace THFW_Portfolio\Database;

use Exception;

class DatabaseProject
{
    private $wpdb;
    private $table_name;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_name = '7tech_portfolio';
    }

    public function saveProject($project)
    {
        $result = $this->wpdb->insert(
            $this->table_name,
            [
                'client_id' => $project['client_id'],
                'post_id' => $project['post_id'],
                'git_repo' => $project['git_repo'],
                'colors' => $project['colors'],
                'logos' => $project['logos'],
                'icons' => $project['icons'],
                'uml_diagrams' => $project['uml_diagrams'],
                'check_list' => $project['check_list'],
                'urls' => $project['urls'],
                'app_stores' => $project['app_stores']
            ]
        );

        if (!$result) {
            $error_message = $this->wpdb->last_error;
            throw new Exception($error_message);
        }

        $project_id = $this->wpdb->insert_id;

        return $project_id;
    }

    public function getProject($client_id)
    {
        $project = $this->wpdb->get_row(
            $this->wpdb->prepare(
                "SELECT * FROM {$this->table_name} WHERE client_id = %d",
                $client_id
            )
        );

        if ($project === null) {
            return rest_ensure_response('Project not found');
        }

        $project_data = [
            'id' => $project->id,
            'client_id' => $project->client_id,
            'deadline' => $project->deadline,
            'deadline_date' => $project->deadline_date,
            'where_business' => $project->where_business,
            'website' => $project->website,
            'website_url' => $project->website_url,
            'hosting' => $project->hosting,
            'satisfied' => $project->satisfied,
            'signage' => $project->signage,
            'signage_url' => $project->signage_url,
            'social' => $project->social,
            'social_facebook' => $project->social_facebook,
            'social_x' => $project->social_x,
            'social_linkedin' => $project->social_linkedin,
            'social_instagram' => $project->social_instagram,
            'logo' => $project->logo,
            'logo_url' => $project->logo_url,
            'colors' => $project->colors,
            'colors_primary' => $project->colors_primary,
            'colors_secondary' => $project->colors_secondary,
            'colors_tertiary' => $project->colors_tertiary,
            'summary' => $project->summary,
            'summary_url' => $project->summary_url,
            'what_business' => $project->what_business,
            'plan' => $project->plan,
            'plan_url' => $project->plan_url,
        ];

        return $project_data;
    }

    public function updateProject($client_id, $project)
    {
        $data = array(
            'client_id' => $project->client_id,
            'deadline' => $project->deadline,
            'deadline_date' => $project->deadline_date,
            'where_business' => $project->where_business,
            'website' => $project->website,
            'website_url' => $project->website_url,
            'hosting' => $project->hosting,
            'satisfied' => $project->satisfied,
            'signage' => $project->signage,
            'signage_url' => $project->signage_url,
            'social' => $project->social,
            'social_facebook' => $project->social_facebook,
            'social_x' => $project->social_x,
            'social_linkedin' => $project->social_linkedin,
            'social_instagram' => $project->social_instagram,
            'logo' => $project->logo,
            'logo_url' => $project->logo_url,
            'colors' => $project->colors,
            'colors_primary' => $project->colors_primary,
            'colors_secondary' => $project->colors_secondary,
            'colors_tertiary' => $project->colors_tertiary,
            'summary' => $project->summary,
            'summary_url' => $project->summary_url,
            'what_business' => $project->what_business,
            'plan' => $project->plan,
            'plan_url' => $project->plan_url,
        );

        $where = array(
            'client_id' => $client_id,
        );

        if (!empty($data)) {
            $updated = $this->wpdb->update($this->table_name, $data, $where);
        }

        if ($updated === false) {
            $error_message = $this->wpdb->last_error ?: 'Project not found';
            $response = rest_ensure_response($error_message);
            $response->set_status(404);

            return $response;
        }

        return $updated;
    }
}
