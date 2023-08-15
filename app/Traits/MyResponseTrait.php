<?php

namespace App\Traits;

trait MyResponseTrait
{
    public function SuccessResponse($data, $message = 'ok', $status = true)
    {
        return response()->json(['status' => $status, 'message' => $message, 'data' => $data]);
    }

    public function ErrorResponse($message = 'error', $errors = [], $error_num = 4, $status = false)
    {
        return response()->json(['status' => $status, 'message' => $message, 'error_num' => $error_num, 'errors' => $errors]);
    }
}
