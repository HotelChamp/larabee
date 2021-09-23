<?php

namespace Hotelchamp\Larabee;

use ChargeBee_Environment as Environment;
use Hotelchamp\Larabee\Resources\Customers;
use Hotelchamp\Larabee\Resources\Estimates;
use Hotelchamp\Larabee\Resources\HostedPages;
use Hotelchamp\Larabee\Resources\Invoices;
use Hotelchamp\Larabee\Resources\Plans;
use Hotelchamp\Larabee\Resources\PortalSessions;
use Hotelchamp\Larabee\Resources\Subscriptions;
use Hotelchamp\Larabee\Contracts\Client as ClientContract;

class Client implements ClientContract
{
    /**
     * Construct the client
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $options = array_merge([
            'site' => $options['site'] ?? config('larabee.site'),
            'api_key' => $options['api_key'] ?? config('larabee.api_key')
        ], $options);

        Environment::configure($options['site'], $options['api_key']);
    }

    /**
     * Handle customers endpoint
     *
     * @return Customers
     */
    public function customers(): Customers
    {
        return new Customers();
    }

    /**
     * Handle subscriptions endpoint
     *
     * @return Subscriptions
     */
    public function subscriptions(): Subscriptions
    {
        return new Subscriptions();
    }

    /**
     * Handle estimates endpoint
     *
     * @return Estimates
     */
    public function estimates(): Estimates
    {
        return new Estimates();
    }

    /**
     * Handles plans endpoint
     *
     * @return Plans
     */
    public function plans(): Plans
    {
        return new Plans();
    }

    /**
     * Handles invoices endpoint
     *
     * @return Invoices
     */
    public function invoices(): Invoices
    {
        return new Invoices();
    }

    /**
     * Handles portal sessions endpoint
     *
     * @return PortalSessions
     */
    public function portalSessions(): PortalSessions
    {
        return new PortalSessions();
    }

    /**
     * Handle hosted pages endpoint
     *
     * @return HostedPages
     */
    public function hostedPages(): HostedPages
    {
        return new HostedPages();
    }
}
