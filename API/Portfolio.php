<?php

namespace SEVEN_TECH\Portfolio\API;

use Exception;

use SEVEN_TECH\Portfolio\Post_Types\Portfolio\Portfolio as PT_Portfolio;

class Portfolio
{
    private $portfolio;

    public function __construct()
    {
        $this->portfolio = new PT_Portfolio;
    }

    public function get_portfolio()
    {
        try {
            $portfolio = $this->portfolio->getPortfolio();

            if (empty($portfolio)) {
                throw new Exception('No projects were found', 404);
            }

            return rest_ensure_response($portfolio);
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
