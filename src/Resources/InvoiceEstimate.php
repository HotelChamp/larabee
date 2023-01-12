<?php

namespace Hotelchamp\Larabee\Resources;

use ChargeBee_Subscription as CbSubscription;

class InvoiceEstimate
{
    /**
     * Chargebee subscription
     *
     * @var CbSubscription $base
     */
    protected CbSubscription $base;

    /**
     * Estimated subscription renewal amount
     *
     * @var float|null
     */
    public null|float $amountDue;

    /**
     * Construct a InvoiceEstimate
     *
     * @param CbSubscription $base
     */
    public function __construct(CbSubscription $base)
    {
        $this->base = $base;
        $this->setTotalDue();
    }

    /**
     * Set the total due amount
     */
    protected function setTotalDue()
    {
        try {
            $estimate = (new Estimates())->renewalEstimate($this->id);

            if (! is_null($estimate)) {
                $this->amountDue = $estimate->invoiceEstimate->amountDue;
            }
        } catch (\Exception $e) {
            $this->amountDue = null;
        }
    }

    /**
     * Get value for provided key
     *
     * @param $key
     * @return mixed|null
     */
    public function __get($key)
    {
        return $this->base->{$key};
    }
}
