<?php

namespace Drivezy\LaravelMarketing\Libraries\Offer;

/**
 * Class FlatCampaignOffer
 * @package Drivezy\LaravelMarketing\Libraries\Offer
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class FlatCampaignOffer extends BaseCampaignOffer {
    /**
     * Sets offer value
     */
    protected function setOfferValue () {
        $this->request->coupon_benefits[ $this->offerNature ] = $this->getFlatAmount();
    }

    /**
     * Gets flat offer amount.
     *
     * @return float
     */
    protected function getFlatAmount () {
        return $this->offerApplicableAmount > $this->offer->rate ? $this->offer->rate : $this->offerApplicableAmount;
    }
}