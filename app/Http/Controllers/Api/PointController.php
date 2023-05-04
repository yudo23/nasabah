<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PointService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\JSONResponseHelper;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Log;

class PointController extends Controller
{

    protected PointService $pointService;

    public function __construct()
    {
        $this->pointService = new PointService();
    }

    public function index(Request $request)
    {
        try {
            $response = $this->pointService->index($request);
            if (!$response->success) {
                return JSONResponseHelper::print(false, $response->message, $response->data, $response->code);
            }

            return JSONResponseHelper::print(true, $response->message , $response->data);
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return JSONResponseHelper::print(false, $th->getMessage(), null , Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
