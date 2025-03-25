<?php

namespace SEVEN_TECH\Model\Project;

use SEVEN_TECH\Model\CheckList;

class ProjectCheckList
{
    public CheckList $designCheckList;
    public CheckList $developmentCheckList;
    public CheckList $deliveryCheckList;
    public int $totalWeight;
}
