<?php

namespace SEVEN_TECH\Model\Project;

use SEVEN_TECH\Model\Gallery;
use SEVEN_TECH\Model\Features;

use SEVEN_TECH\Model\Project\ProjectURLs;

class Solution {
    public Gallery $gallery;
    public Features $features;
    public string $contentURL;
    public ProjectURLs $projectURLs;
}
