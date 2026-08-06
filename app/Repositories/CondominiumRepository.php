<?php

namespace App\Repositories;

use App\Models\Condominium;
use Illuminate\Pagination\LengthAwarePaginator;

class CondominiumRepository
{
    public function store(array $data): Condominium
    {
        return Condominium::create($data);
    }

    public function findAll(int $perPage = 20): LengthAwarePaginator
    {
        return Condominium::paginate($perPage);
    }

    public function findById(string $uuid): ?Condominium
    {
        return Condominium::where('uuid', $uuid)->first();
    }

    public function delete(Condominium $condominium): bool
    {
        return $condominium->delete();
    }

    public function update(Condominium $condominium, array $data): bool
    {
        return $condominium->update($data);
    }
}
