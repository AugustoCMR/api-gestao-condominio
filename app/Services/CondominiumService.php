<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Condominium;
use App\Repositories\CondominiumRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class CondominiumService
{
    public function __construct(private CondominiumRepository $repository)
    {
    }

    public function create(array $data): Condominium
    {
        return $this->repository->store($data);
    }

    public function findAll(): LengthAwarePaginator
    {
        return $this->repository->findAll();
    }

    public function findById(string $uuid): ?Condominium
    {
        $condominium = $this->repository->findById($uuid);

        if (!$condominium)
        {
            throw new NotFoundException('Condominío não encontrado');
        }

        return $condominium;
    }

    public function update(string $uuid, array $data): Condominium
    {
        $condominium = $this->repository->findById($uuid);

        $this->repository->update($condominium, $data);

        return $condominium->fresh();
    }

    public function delete(string $uuid): bool
    {
        $condominium = $this->repository->findById($uuid);

        $this->repository->delete($condominium);

        return true;
    }
}
