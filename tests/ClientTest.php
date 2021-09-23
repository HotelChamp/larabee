<?php

namespace Hotelchamp\Larabee\Tests;

use Hotelchamp\Larabee\Client;
use Hotelchamp\Larabee\Resources\Customers;
use Hotelchamp\Larabee\Resources\HostedPages;
use Hotelchamp\Larabee\Resources\Invoices;
use Hotelchamp\Larabee\Resources\Plans;
use Hotelchamp\Larabee\Resources\PortalSessions;
use Hotelchamp\Larabee\Resources\Subscriptions;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
     protected Client $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = $this->createStub(Client::class);
    }

    /**
     * Test it creates a client
     */
    public function testItCreatesAClient()
    {
        $this->assertInstanceOf(
            Client::class,
            $this->client,
        );
    }

    /**
     * Test it handles subscriptions endpoint
     */
    public function testItHandlesSubscriptions()
    {
        $subscriptions = $this->client->subscriptions();

        $this->assertInstanceOf(
            Subscriptions::class,
            $subscriptions
        );
    }

    /**
     * Test it handles customers endpoint
     */
    public function testItHandlesCustomers()
    {
        $customers = $this->client->customers();

        $this->assertInstanceOf(
            Customers::class,
            $customers
        );
    }

    /**
     * Test it handles plans endpoint
     */
    public function testItHandlesPlans()
    {
        $plans = $this->client->plans();

        $this->assertInstanceOf(
            Plans::class,
            $plans
        );
    }

    /**
     * Test it handles invoices endpoint
     */
    public function testItHandlesInvoices()
    {
        $invoices = $this->client->invoices();

        $this->assertInstanceOf(
            Invoices::class,
            $invoices
        );
    }

    /**
     * Test it handles portal sessions endpoint
     */
    public function testItHandlesPortalSessions()
    {
        $sessions = $this->client->portalSessions();

        $this->assertInstanceOf(
            PortalSessions::class,
            $sessions
        );
    }

    /**
     * Test it handles hosted pages endpoint
     */
    public function testItHandlesHostedPages()
    {
        $pages = $this->client->hostedPages();

        $this->assertInstanceOf(
            HostedPages::class,
            $pages
        );
    }
}
