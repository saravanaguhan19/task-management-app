<?php


namespace App\Traits;

trait ResponseTrait
{

    public function formatResponse(string|array $response, int $statusCode)
    {

        return response()->json(
            [
                "error message" => $response
            ],
            $statusCode
        );
    }
}
