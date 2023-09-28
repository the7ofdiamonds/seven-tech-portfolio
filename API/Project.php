<?php

namespace THFW_Portfolio\API;

use Exception;

use WP_REST_Request;
use WP_Query;

use THFW_Portfolio\Database\OnboardingDatabase;
use THFW_Portfolio\Database\TheProblemDatabase;

class Project
{
    private $post_type;

    public function __construct()
    {
        $this->post_type = 'portfolio';

        add_action('rest_api_init', function () {
            register_rest_route('thfw/v1', '/portfolio/(?P<slug>[a-zA-Z0-9-_]+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_project'),
                'permission_callback' => '__return_true',
            ));
        });
    }

    public function get_project(WP_REST_Request $request)
    {
        try {
            $slug = $request->get_param('slug');
            $args = array(
                'post_type' => $this->post_type,
                'name' => $slug,
                'posts_per_page' => 1,
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                $query->the_post();
                $post_data = array(
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'description' => get_post_meta(get_the_ID(), '_service_description', true),
                    'content' => strip_tags(strip_shortcodes(get_the_content())),
                    'features' => get_post_meta(get_the_ID(), '_service_features', true),
                    'icon' => get_post_meta(get_the_ID(), '_service_icon', true),
                    'action_word' => get_post_meta(get_the_ID(), '_services_button', true),
                    'slug' => get_post_field('post_name', get_the_ID()),
                    'cost' => get_post_meta(get_the_ID(), '_service_cost', true),
                );

                return rest_ensure_response($post_data, 200);
            } else {
                $status_code = 404;
                $response_data = [
                    'message' => 'Post not found',
                    'status' => $status_code
                ];

                $response = rest_ensure_response($response_data);
                $response->set_status($status_code);

                return $response;
            }
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            $status_code = $e->getCode();

            $response_data = [
                'message' => $error_message,
                'status' => $status_code
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($status_code);

            return $response;
        }
    }
}
