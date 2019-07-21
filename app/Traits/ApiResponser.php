<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponser
{
    private function successResponse($data, $code)
    {
        return response()->json(
            $data,
            $code
        );
    }

    protected function errorResponse($message, $code = 500)
    {
        return response()->json(
            [
                'data' => [
                    'error' => $message,
                    'code' => $code,
                ]
            ],
            $code
        );
    }

    protected function showAll(Collection $collection, $code = 200)
    {
        return $this->successResponse([
            'data' => $collection
        ],
            $code
        );
    }

    protected function showOne(Model $model, $message = 'Carga con éxito', $code = 200)
    {
        return $this->successResponse([
            'data' => $model,
            'message' => $message,
        ],
            $code
        );
    }
}
