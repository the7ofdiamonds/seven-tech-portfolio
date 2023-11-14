<?php

namespace SEVEN_TECH\Portfolio\Post_Types;

class Post_Types
{
    public $post_types_list;

    public function __construct()
    {
        $this->post_types_list = [
            'portfolio',
        ];
    }

    public function get_taxonomies($post_type){
        error_log($post_type);
        $taxonomies = get_object_taxonomies($post_type);

        error_log(print_r($taxonomies, true));

    }
}
