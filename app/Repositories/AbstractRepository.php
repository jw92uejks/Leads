<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AbstractRepository implements RepositoryInterface
{
    protected static $model;

    public static function loadModel(): Model
    {
        return app(static::$model);
    }

    public static function all(): Collection
    {
        return self::loadModel()::all();
    }

    public static function create(array $attributes): Model
    {
        return self::loadModel()::query()->create($attributes);
    }

    public static function createMany(array $records): bool
    {
        return self::loadModel()::insert($records);
    }

    public static function find(int $id): ?Model
    {
        return self::loadModel()::query()->find($id);
    }

    public static function findOrFail(int $id): Model
    {
        return self::loadModel()::query()->findOrFail($id);
    }

    public static function findMany(array $ids): Collection
    {
        return self::loadModel()::query()->whereIn('id', $ids)->get();
    }

    public static function delete(int $id): bool
    {
        return self::loadModel()::query()->where(['id' => $id])->delete() > 0;
    }

    public static function update(int $id, array $attributes): bool
    {
        return self::loadModel()::query()->where(['id' => $id])->update($attributes) > 0;
    }
}
