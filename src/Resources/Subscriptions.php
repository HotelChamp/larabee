<?php

namespace Hotelchamp\Larabee\Resources;

use ChargeBee_Customer as Customer;
use ChargeBee_Subscription as Subscription;
use Illuminate\Support\Collection;

class Subscriptions extends FilterableResource
{
    /**
     * Get all subscriptions with possible filtering
     *
     * @return Collection
     */
    public function all(): Collection
    {
        if ($this->filter['withEstimate']) {
            return $this->allWithEstimate();
        }

        return collect(Subscription::all($this->filter))->map->subscription();
    }

    /**
     * Get all subscriptions with their renewal estimates
     *
     * @return Collection
     */
    public function allWithEstimate(): Collection
    {
        return  collect(Subscription::all($this->filter))->map(function ($result) {
            return new InvoiceEstimate($result->subscription());
        });
    }

    /**
     * Find a subscription by id
     *
     * @param string $id
     * @return mixed
     */
    public function findById(string $id): mixed
    {
        if ($this->filter && $this->filter['withEstimate']) {
            return $this->withEstimate($id);
        }

        return Subscription::retrieve($id)->subscription();
    }

    /**
     * Get a subscription with its renewal estimate
     *
     * @param string $id
     * @return InvoiceEstimate
     */
    public function withEstimate(string $id): InvoiceEstimate
    {
        return new InvoiceEstimate($this->findById($id));
    }

    /**
     * Get the customer for the subscription
     *
     * @param string $subscriptionId
     * @return Customer
     */
    public function getSubscriptionCustomer(string $subscriptionId): Customer
    {
        return Subscription::retrieve($subscriptionId)->customer();
    }

    /**
     * Cancel items of a subscription
     *
     * @param string $id
     * @param array $items
     * @return Subscription
     */
    public function cancelForItems(string $id, array $items): Subscription
    {
        return Subscription::cancelForItems($id, $items)->subscription();
    }

    /**
     * Cancel a subscription
     *
     * @param string $id
     * @return Subscription
     */
    public function cancel(string $id): Subscription
    {
        return Subscription::cancel($id)->subscription();
    }

    /**
     * Pause a subscription
     *
     * @param string $id
     * @param array $options
     * @return Subscription
     */
    public function pause(string $id, array $options): Subscription
    {
        return Subscription::pause($id, $options)->subscription();
    }

    /**
     * Resume a subscription
     *
     * @param string $id
     * @param array $options
     * @return Subscription
     */
    public function resume(string $id, array $options): Subscription
    {
        return Subscription::resume($id, $options)->subscription();
    }

    /**
     * Reactivate a subscription
     *
     * @param string $id
     * @return Subscription
     */
    public function reactivate(string $id): Subscription
    {
        return Subscription::reactivate($id)->subscription();
    }

    /**
     * Create a subscription
     *
     * @param array $items
     * @return Subscription
     */
    public function create(array $items): Subscription
    {
        return Subscription::create($items)->subscription();
    }

    /**
     * Update a subscription
     *
     * @param string $id
     * @param array $items
     * @return Subscription
     */
    public function update(string $id, array $items): Subscription
    {
        return Subscription::update($id, $items)->subscription();
    }

    /**
     * Delete a subscription
     *
     * @param string $id
     * @return Subscription
     */
    public function delete(string $id): Subscription
    {
        return Subscription::delete($id)->subscription();
    }
}
