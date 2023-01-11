<?php

namespace Hotelchamp\Larabee\Resources;

use ChargeBee\ChargeBee\Models\Customer;
use Illuminate\Support\Collection;

class Customers extends FilterableResource
{
    /**
     * Get all customers with possibility of filtering results
     *
     * @return Collection
     */
    public function all(): Collection
    {
        $all = Customer::all($this->filter);

        return collect($all)->map->customer();
    }

    /**
     * Find a customer by id
     *
     * @param string $id
     * @return Customer
     */
    public function findById(string $id): Customer
    {
        return Customer::retrieve($id)->customer();
    }

    /**
     * Create a customer entity
     *
     * @param array $data
     * @return Customer
     */
    public function create(array $data): Customer
    {
        return Customer::create($data)->customer();
    }

    /**
     * Update a customer entity
     *
     * @param string $id
     * @param array $data
     * @return Customer
     */
    public function update(string $id, array $data): Customer
    {
        return Customer::update($id, $data)->customer();
    }

    /**
     * Get customer contacts
     *
     * @param string $id
     * @return Collection
     */
    public function contacts(string $id): Collection
    {
        $result = Customer::contactsForCustomer($id);

        return collect($result)->map->contact();
    }

    /**
     * Delete a customer
     *
     * @param string $id
     * @return Customer
     */
    public function delete(string $id): Customer
    {
        return Customer::delete($id)->customer();
    }
}
