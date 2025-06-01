<?php

namespace SEVEN_TECH\Portfolio\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Portfolio\Taxonomies\Skills as ProjectSkills;

use SEVEN_TECH\Portfolio\Model\Term;

class Skills
{
    private $tax;

    public function __construct()
    {
        $this->tax = new ProjectSkills;
    }

    public function add_skill(WP_REST_Request $request)
    {
        try {
            $body = $request->get_json_params();

            $term = new Term();
            $term->fromJSON($body);

            $tax = $request->get_param('tax');
            $taxonomy = ucfirst($tax);

            $newTerm = $this->tax->createSkill($term);

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

            $skill = $this->tax->getSkillTerm($taxonomy, $term);

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

            $skills = $this->tax->getSkillTerms($taxonomy);

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
            $skills = $this->tax->getAll();

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

            $termChange = new Term();
            $termChange->fromJSON($body);

            $updatedTerm = $this->tax->updateSkill($taxonomy, $term, $termChange);

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

            $this->tax->deleteSkill($taxonomy, $term);

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
