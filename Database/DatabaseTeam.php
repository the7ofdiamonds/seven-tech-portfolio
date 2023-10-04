<?php

namespace THFW_Portfolio\Database;

use Exception;

class DatabaseTeam
{
    private $wpdb;
    private $table_name;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table_name = '7tech_team';
    }

    function saveMember($member)
    {
        $result = $this->wpdb->insert(
            $this->table_name,
            [
                'user_id' => $member['user_id'],
                'author_url' => $member['author_url'],
                'avatar_url' => $member['avatar_url'],
                'hacker_rank_link' => $member['hacker_rank_link'],
                'linkedin_link' => $member['linkedin_link'],
                'behance_link' => $member['behance_link'],
                'github_link' => $member['github_link'],
            ]
        );

        if (!$result) {
            $error_message = $this->wpdb->last_error;
            throw new Exception($error_message);
        }

        $member_id = $this->wpdb->insert_id;

        return $member_id;
    }

    function getMember($user_id)
    {
        $member = $this->wpdb->get_row(
            $this->wpdb->prepare(
                "SELECT * FROM {$this->table_name} WHERE user_id = %d",
                $user_id
            )
        );

        if ($member === null) {

            throw new Exception('Member not found');
        }

        $member_data = [
            'id' => $member->id,
            'user_id' => $member->user_id,
            'author_url' => $member->author_url,
            'avatar_url' => $member->avatar_url,
            'hacker_rank_link' => $member->hacker_rank_link,
            'linkedin_link' => $member->linkedin_link,
            'behance_link' => $member->behance_link,
            'github_link' => $member->github_link,
        ];

        return $member_data;
    }

    function updateMember($user_id, $member)
    {
        $data = array(
            'user_id' => $member['user_id'],
            'author_url' => $member['author_url'],
            'avatar_url' => $member['avatar_url'],
            'hacker_rank_link' => $member['hacker_rank_link'],
            'linkedin_link' => $member['linkedin_link'],
            'behance_link' => $member['behance_link'],
            'github_link' => $member['github_link'],
        );

        $where = array(
            'user_id' => $user_id,
        );

        $data = array_filter($data, function ($value) {
            return $value !== null;
        });

        if (!empty($data)) {
            $updated = $this->wpdb->update($this->table_name, $data, $where);

            if ($updated === false) {

                throw new Exception('Failed to update member data');
            }

            return 'Member updated successfully';
        } else {

            throw new Exception('No valid member data provided for update');
        }
    }
}
