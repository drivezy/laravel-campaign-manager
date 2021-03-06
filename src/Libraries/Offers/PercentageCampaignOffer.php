<?php

namespace Drivezy\LaravelCampaignManager\Libraries\Offers;

/**
 * Class PercentageCampaignOffer
 * @package Drivezy\LaravelCampaignManager\Libraries\Offer
 * @author  Yash Devkota <devkotayash4098@gmail.com>
 */
class PercentageCampaignOffer extends BaseCampaignOffer
{
    /**
     * Sets offer value
     */
    protected function setOfferValue ()
    {
        $this->request->coupon_benefits[ $this->offerNature ] += $this->getPercentageAmount();
    }

    /**
     * Gets percentage offer amount.
     *
     * @return float
     */
    protected function getPercentageAmount ()
    {
        $offAmount = 0;
        foreach ( $this->offerApplicablePricing as $accountHead => $amount )
            $offAmount += $amount * $this->offer->rate / 100;

        if ( !$this->offer->maximum_offer_value )
            return $offAmount;

        return $offAmount > $this->offer->maximum_offer_value ? $this->offer->maximum_offer_value : $offAmount;
    }
}
