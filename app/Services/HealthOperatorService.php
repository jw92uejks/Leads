<?php

namespace App\Services;

use App\Interfaces\HealthOperatorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class HealthOperatorService
{
    public function __construct(
        private readonly HealthOperatorRepositoryInterface $repository
    ) {}

    public function listActiveOperators(): Collection
    {
        return $this->repository->getAllActive();
    }

    public function listAllOperators(): Collection
    {
        return $this->repository->getAll();
    }

    public function getOperatorById(int $id): ?object
    {
        return $this->repository->findById($id);
    }
}

