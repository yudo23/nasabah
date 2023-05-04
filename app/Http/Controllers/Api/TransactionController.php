<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\StoreRequest;
use App\Http\Requests\Transaction\UpdateRequest;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\JSONResponseHelper;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Log;

class TransactionController extends Controller
{

    protected TransactionService $transactionService;

    public function __construct()
    {
        $this->transactionService = new TransactionService();
    }

    public function index(Request $request)
    {
        try {
            $response = $this->transactionService->index($request);
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
            $response = $this->transactionService->store($request);
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
        $result = $this->transactionService->show($id);
        if (!$result->success) {
            return JSONResponseHelper::print(false, $result->message, $result->data, $result->code);
        }
        $result = $result;

        return JSONResponseHelper::print(true, $result->message , $result->data);
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $response = $this->transactionService->update($request, $id);
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
            $response = $this->transactionService->delete($id);
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
