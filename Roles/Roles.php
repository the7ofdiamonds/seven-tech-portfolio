<?php

namespace SEVEN_TECH\Portfolio\Roles;

class Roles
{
    public $roles;

    public function __construct()
    {
        $this->roles = [
            [
                'role' => 'team member',
                'display_name' => 'Team Member'
            ], [
                'role' => 'scrum master',
                'display_name' => 'Scrum Master'
            ], [
                'role' => 'software development engineer',
                'display_name' => 'Software Development Engineer'
            ], [
                'role' => 'full stack web developer',
                'display_name' => 'Full Stack Web Developer'
            ], [
                'role' => 'designer',
                'display_name' => 'Designer'
            ], [
                'role' => 'frontend developer',
                'display_name' => 'Frontend Developer'
            ], [
                'role' => 'backend developer',
                'display_name' => 'Backend Developer'
            ], [
                'role' => 'artist',
                'display_name' => 'Artist'
            ],
        ];
    }

    function add_roles()
    {
        foreach ($this->roles as $role) {
            add_role($role['role'], $role['display_name'], get_role('contributor')->capabilities);
        }
    }
}
