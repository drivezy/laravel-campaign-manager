<?php

namespace Drivezy\LaravelCampaignManager\Libraries\Validations;

use Drivezy\LaravelCampaignManager\Libraries\CouponDataTrait;
use Drivezy\LaravelUtility\Library\DateUtil;

/**
 * Class TermCampaignValidation
 * @package Drivezy\LaravelCampaignManager\Libraries\Validations
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class TermCampaignValidation extends BaseCampaignValidation
{
    use CouponDataTrait;

    /**
     * Timings related to the campaign/coupon
     *
     * @var object
     */
    private $term = false;

    /**
     * Sets operand for comparision.
     */
    protected function setOperand ()
    {
        $this->term = $this->getCouponData('term');
        if ( !count($this->term) ) return $this->operand = true;

        $this->term = $this->term[0];
        $this->operand = $this->isCampaignTimeValid();
        if ( !$this->operand ) return;

        return $this->operand = $this->isAssetTimeValid();
    }

    /**
     * Checks if campaign is valid for current time.
     *
     * @return bool
     */
    private function isCampaignTimeValid ()
    {
        $couponAppliedAt = $this->request->coupon_applied_at ?? DateUtil::getDateTime();

        return ( $this->term->valid_from <= $couponAppliedAt && $this->term->valid_to >= $couponAppliedAt );
    }

    /**
     * Checks if campaign is valid for time of asset acquisition.
     *
     * @return bool
     */
    private function isAssetTimeValid ()
    {
        if ( !$this->term->start_time || !$this->term->end_time ) return true;

        $startTime = $this->request->original_pricing_start_time ?? $this->request->start_time;
        $endTime = $this->request->original_pricing_end_time ?? $this->request->end_time;

        return ( $this->term->start_time <= $startTime && $this->term->end_time >= $endTime );
    }
}
