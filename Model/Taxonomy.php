<?php

namespace SEVEN_TECH\Model;

class Taxonomy
{
    public string $id;
    public string $type;
    public string $title;
    public string $path;
    public string $image;
    public string $usage;

    public function __construct(string $json)
    {
        $data = json_decode($json, true);

        if (!is_array($data)) {
            throw new \InvalidArgumentException('Invalid JSON input');
        }

        $this->id = $data['id'];
        $this->type = $data['type'];
        $this->title = $data['title'];
        $this->path = $data['path'];
        $this->image = $data['image'];
        $this->usage = $data['usage'];
    }
}

class ProjectType extends Taxonomy {}

class Language extends Taxonomy {}

class Framework extends Taxonomy {}

class Technology extends Taxonomy {}

class Service extends Taxonomy {}
