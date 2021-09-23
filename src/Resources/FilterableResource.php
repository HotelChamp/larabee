<?php

namespace Hotelchamp\Larabee\Resources;

use Closure;
use Illuminate\Support\Collection;
use Hotelchamp\Larabee\Contracts\Resource;
use Hotelchamp\Larabee\Filters\FilterBuilder;

/**
 * @method FilterBuilder where($attribute, $operator, $value = null)
 * @method FilterBuilder whereIf($attribute, $operator, $value, $condition)
 * @method FilterBuilder whereIn($attribute, $values)
 * @method FilterBuilder limit($limit)
 * @method FilterBuilder withEstimate()
 * @method FilterBuilder sortBy($attribute, $direction)
 * @method Collection get()
 * @method mixed first()
 */
abstract class FilterableResource implements Resource
{
    /**
     * The filtering array
     *
     * @var array|null $filter
     */
    protected null|array $filter = null;

    /**
     * @inheritDoc
     */
    abstract public function all(): Collection;

    public function __call($method, $args)
    {
        return (new FilterBuilder(Closure::fromCallable([$this, 'filtered'])))->{$method}(...$args);
    }

    /**
     * Set the filter and return the result
     *
     * @param array $filter
     * @return Collection
     */
    protected function filtered(array $filter): Collection
    {
        $this->filter = $filter;

        return $this->all();
    }
}
