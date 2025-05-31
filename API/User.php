<?php

namespace SEVEN_TECH\Portfolio\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Portfolio\Taxonomies\Taxonomies as Tax;
use SEVEN_TECH\Portfolio\Taxonomies\ProjectTypes;

class Taxonomies
{
    private $post_type;
    private $tax;
    private $project_types;

    public function __construct()
    {
        $this->post_type = 'portfolio';
        $this->tax = new Tax;
        $this->project_types = new ProjectTypes;
    }

    public function get_project_types_by_user(WP_REST_Request $request)
    {
        try {
            $nicename = $request->get_param('slug');
            $project_types = $this->project_types->getProjectTypesByUser($this->post_type);

            if (empty($project_types)) {
                throw new Exception('No projects found with a Project Type.', 404);
            }

            return rest_ensure_response(['projectTypes' => $project_types]);
        } catch (Exception $e) {
            $statusCode = $e->getCode();

            $response_data = [
                'error_message' => $e->getMessage(),
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    public function get_skills_by_user(WP_REST_Request $request)
    {
        try {
            $nicename = $request->get_param('slug');

            $skills = $this->tax->getPostTypeTaxonomiesByUser($nicename, $this->post_type, 'Skills');

            if (empty($skills)) {
                throw new Exception('No projects found with a Skill.', 404);
            }

            return rest_ensure_response(['skills' => $skills]);
        } catch (Exception $e) {
            $statusCode = $e->getCode();

            $response_data = [
                'error_message' => $e->getMessage(),
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    public function get_frameworks_by_user(WP_REST_Request $request)
    {
        try {
            $nicename = $request->get_param('slug');

            $frameworks = $this->tax->getPostTypeTaxonomiesByUser($nicename, $this->post_type, 'Frameworks');

            if (empty($frameworks)) {
                throw new Exception('No projects found with a Framework.', 404);
            }

            return rest_ensure_response(['frameworks' => $frameworks]);
        } catch (Exception $e) {
            $statusCode = $e->getCode();

            $response_data = [
                'error_message' => $e->getMessage(),
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    public function get_technologies_by_user(WP_REST_Request $request)
    {
        try {
            $nicename = $request->get_param('slug');
            
            $technologies = $this->tax->getPostTypeTaxonomiesByUser($nicename, $this->post_type, 'Technologies');

            if (empty($technologies)) {
                throw new Exception('No projects found with a Technology.', 404);
            }

            return rest_ensure_response(['technologies' => $technologies]);
        } catch (Exception $e) {
            $statusCode = $e->getCode();

            $response_data = [
                'error_message' => $e->getMessage(),
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    public function get_project_type_by_user(WP_REST_Request $request)
    {
        try {
            $nicename = $request->get_param('slug');
            $term = '';
            $project_type = $this->project_types->getProjectTypeByUser($nicename, $term);

            if (empty($project_type)) {
                throw new Exception('No projects found with a Project Type.', 404);
            }

            return rest_ensure_response(['projectType' => $project_type]);
        } catch (Exception $e) {
            $statusCode = $e->getCode();

            $response_data = [
                'error_message' => $e->getMessage(),
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    public function get_skill_by_user(WP_REST_Request $request)
    {
        try {
            $nicename = $request->get_param('slug');
            $term = '';
            $skill = $this->tax->getTaxonomyTermByUser($nicename, 'Skills', $term);

            if (empty($skill)) {
                throw new Exception('No projects found with a Skill.', 404);
            }

            return rest_ensure_response(['skill' => $skill]);
        } catch (Exception $e) {
            $statusCode = $e->getCode();

            $response_data = [
                'error_message' => $e->getMessage(),
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    public function get_framework_by_user(WP_REST_Request $request)
    {
        try {
            $nicename = $request->get_param('slug');
            $term = '';
            $framework = $this->tax->getTaxonomyTermByUser($nicename, 'Frameworks', $term);

            if (empty($framework)) {
                throw new Exception('No projects found with a Framework.', 404);
            }

            return rest_ensure_response(['framework' => $framework]);
        } catch (Exception $e) {
            $statusCode = $e->getCode();

            $response_data = [
                'error_message' => $e->getMessage(),
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    public function get_technology_by_user(WP_REST_Request $request)
    {
        try {
            $nicename = $request->get_param('slug');
            $term = '';
            $technology = $this->tax->getTaxonomyTermByUser($nicename, 'Technologies', $term);

            if (empty($technology)) {
                throw new Exception('No projects found with a Technology.', 404);
            }

            return rest_ensure_response(['technology' => $technology]);
        } catch (Exception $e) {
            $statusCode = $e->getCode();

            $response_data = [
                'error_message' => $e->getMessage(),
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }
}
