<?php

namespace SEVEN_TECH\Portfolio\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Portfolio\Taxonomies\ProjectTags;
use SEVEN_TECH\Portfolio\Taxonomies\ProjectTypes;

class Taxonomies
{
    private $post_type;
    private $projectTags;
    private $projectTypes;

    public function __construct()
    {
        $this->post_type = 'portfolio';
        
        $this->projectTags = new ProjectTags;
        $this->projectTypes = new ProjectTypes;
    }

    public function get_project_types()
    {
        try {
            $project_types = $this->projectTypes->getProjectTypes($this->post_type);

            if (empty($project_types)) {
                throw new Exception('No portfolio types found', 404);
            }

            return rest_ensure_response($project_types);
        } catch (Exception $e) {
            $statusCode = $e->getCode();

            $response_data = [
                'errorMessage' => $e->getMessage(),
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    public function get_project_tags()
    {
        try {
            $project_tags = $this->projectTags->getProjectTags($this->post_type);

            if (empty($project_tags)) {
                throw new Exception('No Project Tags found', 404);
            }

            return rest_ensure_response($project_tags);
        } catch (Exception $e) {
            $statusCode = $e->getCode();

            $response_data = [
                'errorMessage' => $e->getMessage(),
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    public function get_project_type(WP_REST_Request $request)
    {
        try {
            $slug = $request->get_param('slug');

            $project_type = $this->projectTypes->getProjectType($slug);

            if (empty($project_type)) {
                throw new Exception('No portfolio types found', 404);
            }

            return rest_ensure_response($project_type);
        } catch (Exception $e) {
            $statusCode = $e->getCode();

            $response_data = [
                'errorMessage' => $e->getMessage(),
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    public function get_project_tag(WP_REST_Request $request)
    {
        try {
            $slug = $request->get_param('slug');

            $project_tag = $this->projectTags->getProjectTag($slug);

            if (empty($project_tag)) {
                throw new Exception('No Project Tags found', 404);
            }

            return rest_ensure_response($project_tag);
        } catch (Exception $e) {
            $statusCode = $e->getCode();

            $response_data = [
                'errorMessage' => $e->getMessage(),
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }
}
