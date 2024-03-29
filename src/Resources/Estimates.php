<?php

namespace Hotelchamp\Larabee\Resources;

use ChargeBee\ChargeBee\Models\Estimate;

class Estimates
{
    /**
     * Get renewal estimate for a specific subscription
     *
     * @param string $subscriptionId
     * @return Estimate
     */
    public function renewalEstimate(string $subscriptionId): Estimate
    {
        return Estimate::renewalEstimate($subscriptionId)->estimate();
    }
}
