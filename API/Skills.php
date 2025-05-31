<?php

namespace SEVEN_TECH\Portfolio\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Portfolio\Taxonomies\Taxonomies;

use SEVEN_TECH\Portfolio\Model\Image;
use SEVEN_TECH\Portfolio\Model\Term;

class Skills
{
    private $tax;

    public function __construct()
    {
        $this->tax = new Taxonomies;
    }

    public function add_skill(WP_REST_Request $request)
    {
        try {
            $body = $request->get_json_params();

            $term = new Term();
            $term->fromJSON($body);

            $tax = $request->get_param('tax');
            $taxonomy = ucfirst($tax);

            $newTerm = $this->tax->addTerm($term);

            $response = [
                'success_message' => "A new skill of type $taxonomy was added with the title of $term->title successfully.",
                'id' => $newTerm['term_id'],
                'type' => $term->type
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

            return $response;
        }
    }

    public function get_skill(WP_REST_Request $request)
    {
        try {
            $tax = $request->get_param('tax');
            $taxonomy = ucfirst($tax);
            $term = $request->get_param('term');

            $skill = $this->tax->getTaxonomyTerm($taxonomy, $term);

            if (empty($skill)) {
                throw new Exception("No skill of type $taxonomy could be found with the name $term.", 404);
            }

            return rest_ensure_response($skill);
        } catch (Exception $e) {
            $statusCode = $e->getCode();

            $response_data = [
                'error_message' => $e->getMessage(),
                'status_code' => $statusCode
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    public function get_skill_type(WP_REST_Request $request)
    {
        try {
            $tax = $request->get_param('tax');
            $taxonomy = ucfirst($tax);

            $skills = $this->tax->getTaxonomyTerms($taxonomy);

            if (empty($skills)) {
                throw new Exception('No projects found with a Skill.', 404);
            }

            return rest_ensure_response($skills);
        } catch (Exception $e) {
            $statusCode = $e->getCode();

            $response_data = [
                'error_message' => $e->getMessage(),
                'status_code' => $statusCode
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    public function get_skills(WP_REST_Request $request)
    {
        try {
            $skills = $this->tax->getTaxonomies();

            if (empty($skills)) {
                throw new Exception('No projects found with a Skill.', 404);
            }

            return rest_ensure_response($skills);
        } catch (Exception $e) {
            $statusCode = $e->getCode();

            $response_data = [
                'error_message' => $e->getMessage(),
                'status_code' => $statusCode
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    public function update_skill(WP_REST_Request $request)
    {
        try {
            $tax = $request->get_param('tax');
            $taxonomy = ucfirst($tax);
            $term = $request->get_param('term');

            $body = $request->get_json_params();

            $title = isset($body['title']) ? $body['title'] : '';
            $type = isset($body['type']) ? $body['type'] : '';
            $description = isset($body['description']) ? $body['description'] : '';
            $path = isset($body['path']) ? $body['path'] : '';
            $usage = isset($body['usage']) ? $body['usage'] : 0;

            $termChange = new Term();
            $termChange->setTitle($title);
            $termChange->setType($type);
            $termChange->setDescription($description);
            $termChange->setPath($path);

            if (isset($body['image'])) {
                $image = new Image();
                $image->fromJSON($body['image']);

                if (isset($image) && $image instanceof Image) {
                    $termChange->setImage($image);
                }
            }

            $termChange->setUsage($usage);

            $updatedTerm = $this->tax->updateTerm($taxonomy, $term, $termChange);

            $response = [
                'success_message' => "A skill of type $tax was updated called $term successfully.",
                'id' => $updatedTerm['term_id']
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

            return $response;
        }
    }

    public function delete_skill(WP_REST_Request $request)
    {
        try {
            $tax = $request->get_param('tax');
            $taxonomy = ucfirst($tax);
            $term = $request->get_param('term');

            $this->tax->deleteTerm($taxonomy, $term);

            $response = [
                'success_message' => "A skill of type $tax was deleted called $term successfully."
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

            return $response;
        }
    }
}
