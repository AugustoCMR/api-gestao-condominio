<?php

namespace App\Http\Controllers;

use App\Http\Requests\Condominium\StoreCondominiumRequest;
use App\Http\Requests\Condominium\UpdateCondominiumRequest;
use App\Http\Resources\CondominiumResource;
use App\Services\CondominiumService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CondominiumController extends Controller
{
    public function __construct(private CondominiumService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return CondominiumResource::collection($this->service->findAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCondominiumRequest $request): JsonResponse
    {
        return CondominiumResource::make($this->service->create($request->validated()))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid): CondominiumResource
    {
        return CondominiumResource::make($this->service->findById($uuid));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCondominiumRequest $request, string $uuid): CondominiumResource
    {
        return CondominiumResource::make($this->service->update($uuid, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid): Response
    {
        $this->service->delete($uuid);

        return response()->noContent();
    }
}
