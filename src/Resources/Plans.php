<?php

namespace Hotelchamp\Larabee\Resources;

use ChargeBee\ChargeBee\Models\Plan;
use Illuminate\Support\Collection;

/**
 * @deprecated Only used with PC 1.0. For PC 2.0, please see Items
 */
class Plans extends FilterableResource
{
    /**
     * Get all plans with possible filtering
     *
     * @return Collection
     */
    public function all(): Collection
    {
        $all = Plan::all($this->filter);

        return collect($all)->map->plan();
    }

    /**
     * Find a plan by id
     *
     * @param string $id
     * @return Plan
     */
    public function findById(string $id): Plan
    {
        return Plan::retrieve($id)->plan();
    }

    /**
     * Find a plan by planId (key)
     *
     * @param string $planId
     * @return Plan
     */
    public function findByPlanId(string $planId): Plan
    {
        return $this->where('planId', $planId)->get()->first();
    }

    /**
     * Create a plan
     *
     * @param array $plan
     * @return Plan
     */
    public function create(array $plan): Plan
    {
        return Plan::create($plan)->plan();
    }

    /**
     * Update a plan
     *
     * @param string $id
     * @param array $data
     * @return Plan
     */
    public function update(string $id, array $data): Plan
    {
        return Plan::update($id, $data)->plan();
    }

    /**
     * Delete a plan
     *
     * @param string $id
     * @return Plan
     */
    public function delete(string $id): Plan
    {
        return Plan::delete($id)->plan();
    }
}
