<?php

declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public static function all(): Collection;
    public static function create(array $attributes): Model|null;
    public static function createMany(array $records): bool;
    public static function find(int $id): Model|null;
    public static function findMany(array $ids): Collection;
    public static function findOrFail(int $id): Model;
    public static function delete(int $id): bool;
    public static function update(int $id, array $attributes): bool;
    public static function loadModel(): Model;
}
