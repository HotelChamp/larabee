<?php

namespace Hotelchamp\Larabee\Resources;

use ChargeBee\ChargeBee\Models\Item;
use ChargeBee\ChargeBee\Models\Plan;
use Illuminate\Support\Collection;

class Items extends FilterableResource
{

    /**
     * Get all items (previously known as plans) with possible filtering
     *
     * @return Collection
     */
    public function all(): Collection
    {
        $all = Item::all($this->filter);

        return collect($all)->map->item();
    }

    /**
     * Find an item (previously known as a plan) by id
     *
     * @param string $id
     * @return Item|null
     */
    public function findById(string $id): ?Item
    {
        return Item::retrieve($id)->item();
    }

    /**
     * Find an item by item_id (key)
     *
     * @param string $itemId
     * @return Item|null
     */
    public function findByPlanId(string $itemId): ?Item
    {
        return $this->where('item_id', $itemId)->get()->first();
    }

    /**
     * Create an item
     *
     * @param array $item
     * @return Item|null
     */
    public function create(array $item): ?Item
    {
        return Item::create($item)->item();
    }

    /**
     * Update an item
     *
     * @param string $id
     * @param array $data
     * @return Item|null
     */
    public function update(string $id, array $data): ?Item
    {
        return Item::update($id, $data)->item();
    }

    /**
     * Delete a plan
     *
     * @param string $id
     * @return Item
     */
    public function delete(string $id): Item
    {
        return Item::delete($id)->item();
    }
}
