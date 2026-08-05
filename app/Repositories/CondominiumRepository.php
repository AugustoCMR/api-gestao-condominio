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
}
