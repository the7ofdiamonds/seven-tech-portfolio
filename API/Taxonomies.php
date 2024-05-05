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

    public function get_project_types()
    {
        try {
            $project_types = $this->project_types->getProjectTypes($this->post_type);

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
            $frameworks = $this->tax->getPostTypeTaxonomies($this->post_type, 'Frameworks');

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
            $technologies = $this->tax->getPostTypeTaxonomies($this->post_type, 'Technologies');

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

    public function get_project_type(WP_REST_Request $request)
    {
        try {
            $slug = $request->get_param('slug');

            $project_type = $this->project_types->getProjectType($slug);

            if (empty($project_type)) {
                throw new Exception('No projects found with a Project Type.', 404);
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

    public function get_skill(WP_REST_Request $request)
    {
        try {
            $slug = $request->get_param('slug');
            $skill = $this->tax->getTaxonomyTerm($slug, 'Skills');

            if (empty($skill)) {
                throw new Exception('No projects found with a Skill.', 404);
            }

            return rest_ensure_response(['skill' => $skill]);
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

    public function get_framework(WP_REST_Request $request)
    {
        try {
            $slug = $request->get_param('slug');
            $framework = $this->tax->getTaxonomyTerm($slug, 'Frameworks');

            if (empty($framework)) {
                throw new Exception('No projects found with a Framework.', 404);
            }

            return rest_ensure_response(['framework' => $framework]);
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

    public function get_technology(WP_REST_Request $request)
    {
        try {
            $slug = $request->get_param('slug');
            $technology = $this->tax->getTaxonomyTerm($slug, 'Technologies');

            if (empty($technology)) {
                throw new Exception('No projects found with a Technology.', 404);
            }

            return rest_ensure_response(['technology' => $technology]);
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
