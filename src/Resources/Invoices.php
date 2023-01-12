<?php

namespace Hotelchamp\Larabee\Resources;

use ChargeBee_Invoice as Invoice;
use Illuminate\Support\Collection;

class Invoices extends FilterableResource
{

    /**
     * Get all invoices with possible filtering
     *
     * @return Collection
     */
    public function all(): Collection
    {
        $all = Invoice::all($this->filter);

        return collect($all)->map->invoice();
    }

    /**
     * Find an invoice by id
     *
     * @param string $id
     * @return Invoice
     */
    public function findById(string $id): Invoice
    {
        return Invoice::retrieve($id)->invoice();
    }

    /**
     * Create an invoice
     *
     * @param array $data
     * @return Invoice
     */
    public function create(array $data): Invoice
    {
        return Invoice::create($data)->invoice();
    }

    /**
     * Update an invoice
     *
     * @param string $id
     * @param array $data
     * @return Invoice
     */
    public function update(string $id, array $data): Invoice
    {
        return Invoice::updateDetails($id, $data)->invoice();
    }

    /**
     * Delete an invoice
     *
     * @param string $id
     * @return Invoice
     */
    public function delete(string $id): Invoice
    {
        return Invoice::delete($id)->invoice();
    }
}
