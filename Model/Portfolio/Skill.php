<?php

namespace SEVEN_TECH\Portfolio\Model\Portfolio;

use SEVEN_TECH\Portfolio\Model\Image;

use Exception;

class Skill
{
    public string $id;
    public string $type;
    public string | null $title;
    public string | null $description;
    public string | null $path;
    public Image | null $image;
    public string | null $usage;

    public function __construct(
        string $id,
        string $type,
        string | null $title = null,
        string | null $description = null,
        string | null $path = null,
        Image | null $image = null,
        string | null $usage = null
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

    function setTitle(string | null $title)
    {
        $this->title = $title;
    }

    function setDescription(string | null $description)
    {
        $this->description = $description;
    }

    function setPath(string | null $path)
    {
        $this->path = $path;
    }

    function setImage(Image | null $image)
    {
        $this->image = $image;
    }

    function setUsage(string | null $usage)
    {
        $this->usage = $usage;
    }

    public function toJSON()
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'description' => $this->description,
            'path' => $this->path,
            'image' => $this->image ? $this->image->toJSON() : null,
            'usage' => $this->usage
        ];
    }

    function fromJSON(string $json)
    {
        try {
            $data = json_decode($json, true);

            if (!is_array($data)) {
                throw new Exception('Invalid JSON input');
            }

            $this->id = $data['id'];
            $this->type = $data['type'];
            $this->title = $data['title'];
            $this->description = $data['description'];
            $this->path = $data['path'];
            $this->image = $data['image'];
            $this->usage = $data['usage'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
