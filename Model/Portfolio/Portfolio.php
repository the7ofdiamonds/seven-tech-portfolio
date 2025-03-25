<?php

class Portfolio
{
    public array $projects;
    public int $size;

    public function __construct(array $projects) {
        $this->projects = $projects;
        $this->size = sizeOf($projects);
    }
}
