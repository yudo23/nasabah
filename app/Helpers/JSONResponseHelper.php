<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class JSONResponseHelper
{
    /**
     * @param $status
     * @param $message
     * @param $data
     * @param  int  $status_code
     * @return JsonResponse
     */
    public static function print($status, $message, $data = null, int $status_code = 200): JsonResponse
    {
        $response = [];
        $response['success'] = $status;
        $response['message'] = $message;
        if (! empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $status_code);
    }
}
