<?php

namespace SEVEN_TECH\Portfolio\Model;

class Image
{
    public string $id;
    public string $title;
    public string $url;
    public string $className;

    public function __construct(
        string $id = '',
        string $title = '',
        string $url = '',
        string $className = ''
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
        $this->className = $className;
    }

    function fromJSON(array $json)
    {
        $this->id = isset($json['id']) ? $json['id'] : '';
        $this->title = isset($json['title']) ? $json['title'] : '';
        $this->url = isset($json['url']) ? $json['url'] : '';
        $this->className = isset($json['class_name']) ? $json['class_name'] : '';
    }
}
