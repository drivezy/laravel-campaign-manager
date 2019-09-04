<?php

namespace Drivezy\LaravelCampaignManager\Libraries;

/**
 * Trait CouponDataTrait
 * @package Drivezy\LaravelCampaignManager\Libraries
 * @author  Yash Devkota <devkotayash4098@gmail.com>
 */
trait CouponDataTrait
{
    /**
     * Gets coupon data from relationship mapped to coupon|campaign.
     *
     * If relationship data does not exist against
     * coupon, data from coupons campaign is taken.
     *
     * @param $relation relationship against coupon or campaign.
     *
     * @return object|array coupon|campaign data
     */
    public function getCouponData ($relation)
    {
        $data = $this->request->coupon->$relation;
        if ( count($data) ) return $data;

        $data = $this->request->coupon->campaign->$relation;

        return count($data) ? $data : [];
    }
}
