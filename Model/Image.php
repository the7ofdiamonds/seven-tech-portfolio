<?php

namespace SEVEN_TECH\Portfolio\Model;

class Image
{
    public string | null $id;
    public string | null $title;
    public string | null $description;
    public string | null $url;
    public string | null $className;

    public function __construct(
        string $id = null,
        string $title = null,
        string $description = null,
        string $url = null,
        string $className = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->className = $className;
    }

    function setID(string $id)
    {
        $this->id = $id;
    }

    function setTitle(string $title)
    {
        $this->title = $title;
    }

    function setDescription(string $description)
    {
        $this->description = $description;
    }

    function setURL(string $url)
    {
        $this->url = $url;
    }

    function setClassName(string $className)
    {
        $this->className = $className;
    }

    function toJSON()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'class_name' => $this->className
        ];
    }

    function fromJSON(array $json)
    {
        $this->id = isset($json['id']) ? $json['id'] : null;
        $this->title = isset($json['title']) ? $json['title'] : null;
        $this->description = isset($json['description']) ? $json['description'] : null;
        $this->url = isset($json['url']) ? $json['url'] : null;
        $this->className = isset($json['class_name']) ? $json['class_name'] : null;
    }
}
