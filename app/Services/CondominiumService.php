<?php

namespace App\Services;

use App\Models\Condominium;
use App\Repositories\CondominiumRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class CondominiumService
{
    public function __construct(private CondominiumRepository $repository) {}

    public function create(array $data): Condominium
    {
        return $this->repository->store($data);
    }

    public function findAll(): LengthAwarePaginator
    {
        return $this->repository->findAll();
    }
}
