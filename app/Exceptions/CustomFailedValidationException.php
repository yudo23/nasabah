<?php

namespace App\Exceptions;

use App\Helpers\JSONResponseHelper;
use Exception;
use Illuminate\Http\JsonResponse;

class CustomFailedValidationException extends Exception
{
    public function __construct($message = null, $code = 422)
    {
        parent::__construct($message, $code);
    }

    public function render(): JsonResponse
    {
        return JSONResponseHelper::print(false, $this->message, null, $this->code);
    }
}
