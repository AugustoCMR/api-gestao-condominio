<?php

namespace App\Repositories;

use App\Models\Condominium;

class CondominiumRepository
{
    public function store(array $data): Condominium
    {
        return Condominium::create($data);
    }

    public function findAll(): array
    {
        return Condominium::get()->toArray();
    }
}
