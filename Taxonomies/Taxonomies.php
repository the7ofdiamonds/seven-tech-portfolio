<?php

namespace THFW_Portfolio\Taxonomies;

class Taxonomies{
    public function __construct(){
        new TaxonomiesProjectTypes;
        new TaxonomiesProjectTags;
    }
}