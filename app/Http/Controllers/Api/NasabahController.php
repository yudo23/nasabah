<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Nasabah\StoreRequest;
use App\Http\Requests\Nasabah\UpdateRequest;
use App\Services\NasabahService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\JSONResponseHelper;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Log;

class NasabahController extends Controller
{

    protected NasabahService $nasabahService;

    public function __construct()
    {
        $this->nasabahService = new NasabahService();
    }

    public function index(Request $request)
    {
        try {
            $response = $this->nasabahService->index($request);
            if (!$response->success) {
                return JSONResponseHelper::print(false, $response->message, $response->data, $response->code);
            }

            return JSONResponseHelper::print(true, $response->message , $response->data);
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return JSONResponseHelper::print(false, $th->getMessage(), null , Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $response = $this->nasabahService->store($request);
            if (!$response->success) {
                return JSONResponseHelper::print(false, $response->message, $response->data, $response->code);
            }

            return JSONResponseHelper::print(true, $response->message, $response->data);
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return JSONResponseHelper::print(false, $th->getMessage(), null , Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        $result = $this->nasabahService->show($id);
        if (!$result->success) {
            return JSONResponseHelper::print(false, $result->message, $result->data, $result->code);
        }
        $result = $result;

        return JSONResponseHelper::print(true, $result->message , $result->data);
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $response = $this->nasabahService->update($request, $id);
            if (!$response->success) {
                return JSONResponseHelper::print(false, $response->message, $response->data, $response->code);
            }

            return JSONResponseHelper::print(true, $response->message, $response->data);
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return JSONResponseHelper::print(false, $th->getMessage(), null , Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function destroy($id)
    {
        try {
            $response = $this->nasabahService->delete($id);
            if (!$response->success) {
                return JSONResponseHelper::print(false, $response->message, $response->data, $response->code);
            }

            return JSONResponseHelper::print(true, $response->message);
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return JSONResponseHelper::print(false, $th->getMessage(), null , Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
