<?php

namespace Hotelchamp\Larabee\Filters;

use Closure;
use InvalidArgumentException;

class FilterBuilder
{
    /**
     * The constructed filter
     *
     * @var array $filter
     */
    protected array $filter = [];

    /**
     * Allowed operators
     *
     * @var array|string[] $operators
     */
    protected array $operators = [
        '=' => 'is',
        '!=' => 'isNot',
        'in' => 'in',
        'not in' => 'notIn',
        'isset' => 'isPresent',
        'starts with' => 'startsWith',
        '>' => 'gt',
        '>=' => 'gte',
        '<' => 'lt',
        '<=' => 'lte',
        'between' => 'between',
        'on' => 'on',
        'before' => 'before',
        'after' => 'after',
    ];

    /**
     * Callback for passing the constructed filter
     *
     * @var Closure $callback
     */
    protected Closure $callback;

    /**
     * Construct the FilterBuilder
     *
     * @param $callback
     */
    public function __construct($callback)
    {
        $this->callback = $callback;
    }

    /**
     * Adds new entry to the filter
     *
     * @param $attribute
     * @param $operator
     * @param null $value
     * @return $this
     */
    public function where($attribute, $operator, $value = null): self
    {
        if (is_null($value)) {
            $value = $operator;
            $operator = '=';
        }

        if ($this->invalidOperator($operator)) {
            throw new InvalidArgumentException('Passed operator is not valid');
        }

        $key = sprintf('%s[%s]', $attribute, $this->operators[$operator]);

        $this->filter[$key] = $value;

        return $this;
    }

    /**
     * Adds new filter entry if condition is true
     *
     * @param $attribute
     * @param $operator
     * @param $value
     * @param $condition
     * @return $this
     */
    public function whereIf($attribute, $operator, $value, $condition): self
    {
        if ($condition) {
            return $this->where($attribute, $operator, $value);
        }

        return $this;
    }

    /**
     * Shortcut for the 'in' filter
     *
     * @param $attribute
     * @param $values
     * @return $this
     */
    public function whereIn($attribute, $values): self
    {
        return $this->where($attribute, 'in', $values);
    }

    /**
     * Adds a limit entry to the filter
     *
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit): self
    {
        $this->filter['limit'] = $limit;

        return $this;
    }

    /**
     * Adds a sort entry to the filter
     *
     * @param string $attribute
     * @param string $direction
     * @return $this
     */
    public function sortBy(string $attribute, string $direction): self
    {
        $direction = strtolower($direction);

        if (! in_array($direction, ['asc', 'desc'], true)) {
            throw new InvalidArgumentException('Order direction must be "asc" or "desc".');
        }

        $this->filter['sort_by['.$direction.']'] = $attribute;

        return $this;
    }

    /**
     * Enables fetching renewal estimate
     *
     * @return $this
     */
    public function withEstimate(): self
    {
        $this->filter['withEstimate'] = true;

        return $this;
    }

    /**
     * Executes the built filter
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return call_user_func($this->callback, $this->filter);
    }

    /**
     * Helper for returning the first result
     *
     * @return mixed
     */
    public function first(): mixed
    {
        return $this->get()[0];
    }

    /**
     * Check if the passed operator is valid
     *
     * @param $operator
     * @return bool
     */
    protected function invalidOperator($operator): bool
    {
        return ! in_array(strtolower($operator), array_keys($this->operators), true);
    }
}
