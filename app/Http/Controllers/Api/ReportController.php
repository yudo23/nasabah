<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\JSONResponseHelper;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Report\ReportRequest;
use Throwable;
use Log;

class ReportController extends Controller
{

    protected ReportService $reportService;

    public function __construct()
    {
        $this->reportService = new ReportService();
    }

    public function index(ReportRequest $request)
    {
        try {
            $response = $this->reportService->index($request);
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
