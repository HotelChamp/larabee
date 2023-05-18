<?php

namespace Hotelchamp\Larabee\Resources;

use ChargeBee_HostedPage as HostedPage;

class HostedPages
{
    /**
     * Find a hosted page by id
     *
     * @param string $id
     * @return HostedPage
     */
    public function findById(string $id): HostedPage
    {
        return HostedPage::retrieve($id)->hostedPage();
    }

    /**
     * Execute new checkout
     *
     * @param array $data
     * @return HostedPage
     */
    public function newCheckout(array $data): HostedPage
    {
        return HostedPage::checkoutNew($data)->hostedPage();
    }

    /**
     * Manage payment sources.
     *
     * @param array $data
     * @return HostedPage
     */
    public function managePaymentSources(array $data): HostedPage
    {
        return HostedPage::managePaymentSources($data)->hostedPage();
    }
}
