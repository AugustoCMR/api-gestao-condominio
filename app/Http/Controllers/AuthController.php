<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(private AuthService $service)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        return response()->json($this->service->login($request->validated()));
    }
}
