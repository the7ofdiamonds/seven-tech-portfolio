<?php

namespace SEVEN_TECH\Model\Project\Process;

use SEVEN_TECH\Model\CheckList;

class Process
{
    public Status $status;
    public Design $design;
    public Development $development;
    public Delivery $delivery;
    public CheckList $checkList;
}
