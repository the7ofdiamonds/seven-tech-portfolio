<?php

namespace SEVEN_TECH\Portfolio\Post_Types\Portfolio;

class Uploads
{
    function getPhotos($dir)
    {
        $upload_dir = wp_upload_dir();
        $upload_dir_path = $upload_dir['basedir'] . '/' . $dir;
        $upload_url = $upload_dir['baseurl'] . '/' . $dir;

        $photo_urls = [];

        if (file_exists($upload_dir_path) && is_dir($upload_dir_path)) {
            $files = scandir($upload_dir_path);

            $valid_extensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];

            foreach ($files as $file) {
                $file_extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                if (in_array($file_extension, $valid_extensions)) {
                    $photo_url = $upload_url . '/' . $file;

                    $photo_urls[] = $photo_url;
                }
            }
        }

        return $photo_urls;
    }
}
