<?php

namespace SEVEN_TECH\Portfolio\Post_Types\Portfolio;

class Uploads
{
    function getPhotos($project_name, $gallery)
    {
        $upload_dir = wp_upload_dir();
        $upload_dir_path = $upload_dir['basedir'];
        $upload_dir_url = $upload_dir['baseurl'];
        $photo_dir = $upload_dir_path . '/portfolio/' . $project_name . '/' . $gallery;

        $photo_urls = [];

        if (file_exists($photo_dir) && is_dir($photo_dir)) {
            $files = scandir($photo_dir);

            $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];

            foreach ($files as $file) {
                $file_extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                if (in_array($file_extension, $valid_extensions)) {
                    $photo_url = $upload_dir_url . '/portfolio/' . $project_name . '/' . $gallery . '/' . $file;

                    $photo_urls[] = $photo_url;
                }
            }
        }

        return $photo_urls;
    }
}
