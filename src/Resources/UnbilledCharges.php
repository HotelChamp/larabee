<?php

namespace Hotelchamp\Larabee\Resources;

use ChargeBee\ChargeBee\Models\UnbilledCharge;

class UnbilledCharges
{
    /**
     * Create an unbilled charge
     *
     * @param array $data
     * @return array|null
     */
    public function create(array $data): ?array
    {
        return UnbilledCharge::create($data)->unbilledCharges();
    }

    /**
     * Create an unbilled charge with an alternative end-point
     *
     * @param array $data
     * @return array|null
     */
    public function createUnbilledCharge(array $data): ?array
    {
        return UnbilledCharge::createUnbilledCharge($data)->unbilledCharges();
    }
}
