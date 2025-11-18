<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface HealthOperatorRepositoryInterface
{
    public function getAllActive(): Collection;
    public function getAll(): Collection;
    public function findById(int $id): ?object;
}

