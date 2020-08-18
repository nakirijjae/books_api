<?php

namespace Spatie\QueryBuilder\Sorts;

use Illuminate\Database\Eloquent\Builder;

class avgReviewSort implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
      $direction = $descending ? 'DESC' : 'ASC';
      $query->orderByRaw("AVERAGE(`{$property}`) {$direction}");
    }
}
