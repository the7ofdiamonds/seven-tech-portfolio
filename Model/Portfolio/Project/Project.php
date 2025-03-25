<?php

namespace SEVEN_TECH\Model\Project;

use SEVEN_TECH\Model\Project\Process\Process;

class Project
{
    public string $id;
    public string $title;
    public string $description;
    public Solution $solution;
    public Process $process;
    public Problem $problem;
    public Owner $owner;
    public Details $details;
}
