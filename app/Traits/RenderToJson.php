<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait RenderToJson
{
    public function render(): JsonResponse
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], $this->getCode());
    }
}
