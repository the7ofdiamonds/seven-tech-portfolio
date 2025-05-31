<?php

namespace SEVEN_TECH\Portfolio\Model;

use SEVEN_TECH\Portfolio\Model\Image;

class Term
{
    public string $id;
    public string $type;
    public string $title;
    public string $description;
    public string $path;
    public Image | null $image;
    public int $usage;

    public function __construct(
        string $id = '',
        string $type = '',
        string $title = '',
        string $description = '',
        string $path = '',
        Image $image = null,
        int $usage = 0
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->title = $title;
        $this->description = $description;
        $this->path = $path;
        $this->image = $image;
        $this->usage = $usage;
    }

    function setID(string $id)
    {
        $this->id = $id;
    }

    function setType(string $type)
    {
        $this->type = $type;
    }

    function setTitle(string $title)
    {
        $this->title = $title;
    }

    function setDescription(string $description)
    {
        $this->description = $description;
    }

    function setPath(string $path)
    {
        $this->path = $path;
    }

    function setImage(Image $image)
    {
        $this->image = $image;
    }

    function setUsage(int $usage)
    {
        $this->usage = $usage;
    }

    function fromJSON(array $json)
    {
        $this->id = isset($json['id']) ? $json['id'] : '';
        $this->type = isset($json['type']) ? $json['type'] : '';
        $this->title = isset($json['title']) ? $json['title'] : '';
        $this->description = isset($json['description']) ? $json['description'] : '';
        $this->path = isset($json['path']) ? $json['path'] : '';

        if (isset($json['image'])) {
            $image = new Image();
            $image->fromJSON($json['image']);
            $this->image = $image;
        }

        $this->usage = isset($json['usage']) ? $json['usage'] : 0;
    }
}
