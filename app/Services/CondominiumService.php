<?php

namespace App\Services;

use App\Repositories\CondominiumRepository;

class CondominiumService
{
    public function __construct(private CondominiumRepository $repository)
    {
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}
