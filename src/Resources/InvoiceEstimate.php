<?php

namespace Hotelchamp\Larabee\Resources;

use ChargeBee\ChargeBee\Models\Subscription;;

class InvoiceEstimate
{
    /**
     * Chargebee subscription
     *
     * @var Subscription $base
     */
    protected Subscription $base;

    /**
     * Estimated subscription renewal amount
     *
     * @var float|null
     */
    public null|float $amountDue;

    /**
     * Construct a InvoiceEstimate
     *
     * @param Subscription $base
     */
    public function __construct(Subscription $base)
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
