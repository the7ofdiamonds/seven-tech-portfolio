<?php

namespace SEVEN_TECH\Portfolio\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Portfolio\Taxonomies\Taxonomies as Tax;

class Taxonomies
{
    private $post_type;
    private $tax;

    public function __construct()
    {
        $this->post_type = 'portfolio';
        $this->tax = new Tax;
    }

    public function get_project_types()
    {
        try {
            $project_types = $this->tax->getPostTypeTaxonomies($this->post_type, 'project_type');

            if (empty($project_types)) {
                throw new Exception('No projects found with a Project Type.', 404);
            }

            return rest_ensure_response(['projectTypes' => $project_types]);
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

    public function get_skills()
    {
        try {
            $skills = $this->tax->getPostTypeTaxonomies($this->post_type, 'Skills');

            if (empty($skills)) {
                throw new Exception('No projects found with a Skill.', 404);
            }

            return rest_ensure_response(['skills' => $skills]);
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

    public function get_frameworks()
    {
        try {
            $frameworks = $this->tax->getPostTypeTaxonomies($this->post_type, 'frameworks');

            if (empty($frameworks)) {
                throw new Exception('No projects found with a Framework.', 404);
            }

            return rest_ensure_response(['frameworks' => $frameworks]);
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

    public function get_technologies()
    {
        try {
            $skills = $this->tax->getPostTypeTaxonomies($this->post_type, 'technologies');

            if (empty($technologies)) {
                throw new Exception('No projects found with a Technology.', 404);
            }

            return rest_ensure_response(['technologies' => $technologies]);
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
