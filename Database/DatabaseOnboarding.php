<?php

namespace SEVEN_TECH_Portfolio\Database;

use Exception;

class DatabaseOnboarding
{
    private $wpdb;
    private $table_name;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_name = 'SEVEN_TECH_Portfolio_project_onboarding';
    }

    public function saveOnboarding($onboarding)
    {
        $result = $this->wpdb->insert(
            $this->table_name,
            [
                'post_id' => $onboarding['post_id'],
                'client_id' => $onboarding['client_id'],
                'deadline' => $onboarding['deadline'],
                'deadline_date' => $onboarding['deadline_date'],
                'where_business' => $onboarding['where_business'],
                'website' => $onboarding['website'],
                'website_url' => $onboarding['website_url'],
                'hosting' => $onboarding['hosting'],
                'satisfied' => $onboarding['satisfied'],
                'signage' => $onboarding['signage'],
                'signage_url' => $onboarding['signage_url'],
                'social' => $onboarding['social'],
                'social_facebook' => $onboarding['social_facebook'],
                'social_x' => $onboarding['social_x'],
                'social_linkedin' => $onboarding['social_linkedin'],
                'social_instagram' => $onboarding['social_instagram'],
                'logo' => $onboarding['logo'],
                'logo_url' => $onboarding['logo_url'],
                'colors' => $onboarding['colors'],
                'colors_primary' => $onboarding['colors_primary'],
                'colors_secondary' => $onboarding['colors_secondary'],
                'colors_tertiary' => $onboarding['colors_tertiary'],
                'summary' => $onboarding['summary'],
                'summary_url' => $onboarding['summary_url'],
                'plan' => $onboarding['plan'],
                'plan_url' => $onboarding['plan_url'],
            ]
        );

        if (!$result) {
            $error_message = $this->wpdb->last_error;
            throw new Exception($error_message);
        }

        $onboarding_id = $this->wpdb->insert_id;

        return $onboarding_id;
    }

    public function getOnboarding($post_id)
    {
        $onboarding = $this->wpdb->get_row(
            $this->wpdb->prepare(
                "SELECT * FROM {$this->table_name} WHERE post_id = %d",
                $post_id
            )
        );

        if ($onboarding === null) {
            return 'Onboarding not found';
        }

        $onboarding_data = [
            'id' => $onboarding->id,
            'post_id' => $onboarding->post_id,
            'client_id' => $onboarding->client_id,
            'deadline' => $onboarding->deadline,
            'deadline_date' => $onboarding->deadline_date,
            'where_business' => $onboarding->where_business,
            'website' => $onboarding->website,
            'website_url' => $onboarding->website_url,
            'hosting' => $onboarding->hosting,
            'satisfied' => $onboarding->satisfied,
            'signage' => $onboarding->signage,
            'signage_url' => $onboarding->signage_url,
            'social' => $onboarding->social,
            'social_facebook' => $onboarding->social_facebook,
            'social_x' => $onboarding->social_x,
            'social_linkedin' => $onboarding->social_linkedin,
            'social_instagram' => $onboarding->social_instagram,
            'logo' => $onboarding->logo,
            'logo_url' => $onboarding->logo_url,
            'colors' => $onboarding->colors,
            'colors_primary' => $onboarding->colors_primary,
            'colors_secondary' => $onboarding->colors_secondary,
            'colors_tertiary' => $onboarding->colors_tertiary,
            'summary' => $onboarding->summary,
            'summary_url' => $onboarding->summary_url,
            'plan' => $onboarding->plan,
            'plan_url' => $onboarding->plan_url,
        ];

        return $onboarding_data;
    }

    public function updateOnboarding($client_id, $onboarding)
    {
        $data = array(
            'post_id' => $onboarding->post_id,
            'client_id' => $onboarding->client_id,
            'deadline' => $onboarding->deadline,
            'deadline_date' => $onboarding->deadline_date,
            'where_business' => $onboarding->where_business,
            'website' => $onboarding->website,
            'website_url' => $onboarding->website_url,
            'hosting' => $onboarding->hosting,
            'satisfied' => $onboarding->satisfied,
            'signage' => $onboarding->signage,
            'signage_url' => $onboarding->signage_url,
            'social' => $onboarding->social,
            'social_facebook' => $onboarding->social_facebook,
            'social_x' => $onboarding->social_x,
            'social_linkedin' => $onboarding->social_linkedin,
            'social_instagram' => $onboarding->social_instagram,
            'logo' => $onboarding->logo,
            'logo_url' => $onboarding->logo_url,
            'colors' => $onboarding->colors,
            'colors_primary' => $onboarding->colors_primary,
            'colors_secondary' => $onboarding->colors_secondary,
            'colors_tertiary' => $onboarding->colors_tertiary,
            'summary' => $onboarding->summary,
            'summary_url' => $onboarding->summary_url,
            'what_business' => $onboarding->what_business,
            'plan' => $onboarding->plan,
            'plan_url' => $onboarding->plan_url,
        );

        $where = array(
            'client_id' => $client_id,
        );

        if (!empty($data)) {
            $updated = $this->wpdb->update($this->table_name, $data, $where);
        }

        if ($updated === false) {

            throw new Exception($this->wpdb->last_error ?: 'Onboarding not found');
        }

        return $updated;
    }
}
