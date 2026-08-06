<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;

class NotFoundException extends Exception
{
    protected $message = 'Item não encontrado';

    public function render(Request $request): JsonResponse
    {
        return response()->json(['message' => $this->getMessage()], 404);
    }
}
