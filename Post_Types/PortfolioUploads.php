<?php

namespace THFW_Portfolio\Post_Types;

class PortfolioUploads
{
    function getPhotos($project_name, $gallery)
    {
        $upload_dir = wp_upload_dir();

        // Uploads directory path
        $upload_dir_path = $upload_dir['basedir'];

        // Uploads directory URL
        $upload_dir_url = $upload_dir['baseurl'];

        // Define the directory path where photos are located
        $photo_dir = $upload_dir_path . '/portfolio/' . $project_name . '/' . $gallery;

        // Initialize an array to store photo URLs
        $photo_urls = [];

        // Check if the directory exists
        if (file_exists($photo_dir) && is_dir($photo_dir)) {
            // List files in the directory
            $files = scandir($photo_dir);

            // Define valid image file extensions (you can customize this)
            $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];

            foreach ($files as $file) {
                // Get the file extension
                $file_extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                // Check if the file has a valid image extension
                if (in_array($file_extension, $valid_extensions)) {
                    // Generate the URL for the image file
                    $photo_url = $upload_dir_url . '/portfolio/' . $project_name . '/' . $gallery . '/' . $file;

                    // Add the URL to the array
                    $photo_urls[] = $photo_url;
                }
            }
        }

        return $photo_urls;
    }
}
