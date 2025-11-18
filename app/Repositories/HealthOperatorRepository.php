<?php

namespace App\Repositories;

use App\Models\HealthOperator;
use App\Interfaces\HealthOperatorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class HealthOperatorRepository implements HealthOperatorRepositoryInterface
{
    public function __construct(
        private readonly HealthOperator $model
    ) {}

    public function getAllActive(): Collection
    {
        return $this->model
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    public function getAll(): Collection
    {
        return $this->model
            ->orderBy('name')
            ->get();
    }

    public function findById(int $id): ?HealthOperator
    {
        return $this->model->find($id);
    }
}

