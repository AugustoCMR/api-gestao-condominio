<?php

namespace App\Http\Controllers;

use App\Http\Requests\Condominium\StoreCondominiumRequest;
use App\Services\CondominiumService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CondominiumController extends Controller
{
    public function __construct(private CondominiumService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json($this->service->findAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCondominiumRequest $request)
    {
        return response()->json(
            $this->service->create($request->validated()),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid): JsonResponse
    {
        return response()->json($this->service->delete($uuid), 204);
    }
}
