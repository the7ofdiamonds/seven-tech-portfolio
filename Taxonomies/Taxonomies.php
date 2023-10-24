<?php

namespace SEVEN_TECH_Portfolio\Taxonomies;

class Taxonomies
{
    public $taxonomies;

    public function __construct()
    {
        $this->taxonomies = [
            [
                'name' => 'project_types',
                'file_name' => 'ProjectTypes'
            ], [
                'name' => 'project_tags',
                'file_name' => 'ProjectTags'
            ]
        ];

        new TaxonomiesProjectTypes;
        new TaxonomiesProjectTags;
    }
}
