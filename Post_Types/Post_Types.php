<?php

namespace SEVEN_TECH\Portfolio\Post_Types;

class Post_Types
{
    public $post_types_list;

    public function __construct()
    {
        $this->post_types_list = [
            'portfolio' => '\SEVEN_TECH\Portfolio\Post_Types\Post_Type_Portfolio',
        ];

        (new Post_Type_Portfolio)->custom_post_type();
    }
}
