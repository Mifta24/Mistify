<?php

namespace App\Services;

abstract class BaseService
{
    protected function success($data = null, string $message = 'Success')
    {
        return [
            'success' => true,
            'message' => $message,
            'data' => $data
        ];
    }

    protected function error(string $message = 'Error', $data = null)
    {
        return [
            'success' => false,
            'message' => $message,
            'data' => $data
        ];
    }
}
