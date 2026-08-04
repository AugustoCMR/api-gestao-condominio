<?php

namespace App\Http\Controllers;

use App\Http\Requests\Condominium\StoreCondominiumRequest;
use App\Models\Condominium;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CondominiumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCondominiumRequest $request)
    {   
        $condominium = $request->validated();

        $condominium = Condominium::create($condominium);  
        
        return response()->json(
            $condominium,
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
    public function destroy(string $id)
    {
        //
    }
}
