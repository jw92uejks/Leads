<?php
namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class RelatedSort implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        [$relationName, $columnName] = explode(".", $property);

        $relation = $query->getRelation($relationName);

        $aggregate = $descending ? 'MAX' : 'MIN';

        $subquery = $relation
            ->getQuery()
            ->selectRaw("$aggregate($columnName)")
            ->whereColumn(
                $relation->getQualifiedForeignKeyName(),
                $relation->getQualifiedParentKeyName()
            );

        $query->orderBy($subquery, $descending ? "desc" : "asc");
    }
}