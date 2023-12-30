<?php

namespace SEVEN_TECH\Portfolio\Admin;

use SEVEN_TECH\Portfolio\Post_Types\Portfolio\Portfolio;

class Admin
{
    public function __construct()
    {
        new Portfolio;
    }
}
