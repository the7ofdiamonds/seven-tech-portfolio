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

    public function add_skill(WP_REST_Request $request)
    {
        try {
            $body = $request->get_json_params();

            $term_name = $body['title'];
            $taxonomy = $body['type'];
            $description = $body['description'];
            $slug = $body['path'];

            $this->tax->addTerm($term_name, $taxonomy, $description, $slug);

            $response = [
                'success_message' => "A new skill of type $taxonomy was added with the title of $term_name successfully.",
                'type' => $taxonomy
            ];

            return rest_ensure_response($response);
        } catch (Exception $e) {
            $statusCode = $e->getCode();

            $response_data = [
                'error_message' => $e->getMessage(),
                'status_code' => $statusCode
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);
            error_log(print_r($response, true));

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

    public function get_skills(WP_REST_Request $request)
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

    public function update_skill(WP_REST_Request $request)
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

    public function delete_skill(WP_REST_Request $request)
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
}
