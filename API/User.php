<?php

namespace SEVEN_TECH\Portfolio\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Portfolio\User\User as UserClass;

class User
{
    private $user;

    public function __construct()
    {
        $this->user = new UserClass;
    }

    public function get_user_by_github_id(WP_REST_Request $request)
    {
        try {
            $params = $request->get_url_params();
            $id = $params['id'];

            $user = $this->user->getUserByGithubID($id);

            if (empty($user)) {
                throw new Exception('No user found with that GitHub ID.', 404);
            }

            return rest_ensure_response($user);
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
