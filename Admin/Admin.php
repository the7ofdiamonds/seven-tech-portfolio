<?php

namespace SEVEN_TECH\Portfolio\Admin;

use SEVEN_TECH\Portfolio\Post_Types\Post_Type_Portfolio;
use SEVEN_TECH\Portfolio\Taxonomies\Taxonomies;

class Admin
{
    public function __construct()
    {
        new Post_Type_Portfolio;
        new Taxonomies;
    }
}
