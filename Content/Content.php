<?php

namespace SEVEN_TECH\Portfolio\Content;

class Content
{
    function filter($content)
    {
        $contentRegex = '/<!-- wp:paragraph -->(.*?)<!-- \/wp:paragraph -->/s';

        preg_match_all($contentRegex, $content, $matches);

        $contentArray = [];

        foreach ($matches[1] as $matched_content) {
            $contentArray[] = $matched_content;
        }

        return $contentArray;
    }
}
