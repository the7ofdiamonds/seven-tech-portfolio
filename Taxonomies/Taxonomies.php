<?php

namespace SEVEN_TECH_Portfolio\Taxonomies;

class Taxonomies{
    public function __construct(){
        new TaxonomiesProjectTypes;
        new TaxonomiesProjectTags;
    }
}