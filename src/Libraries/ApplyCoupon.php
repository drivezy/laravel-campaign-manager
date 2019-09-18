<?php

namespace Drivezy\LaravelCampaignManager\Libraries;

use Drivezy\LaravelCampaignManager\Libraries\Validations\ModelColumnCampaignValidation;
use Drivezy\LaravelUtility\LaravelUtility;
use Drivezy\LaravelUtility\Library\DateUtil;

/**
 * Class ApplyCoupon
 * @package Drivezy\LaravelCampaignManager\Libraries
 * @author  Yash Devkota <devkotayash4098@gmail.com>
 */
class ApplyCoupon
{
    use CouponDataTrait;

    /**
     * If this is true, validations will be performed. If false, no validation will take place except offer validation.
     *
     * @var boolean
     */
    private $validateCouponFlag = true;

    /**
     * Contains data about pricing, coupon and other factors that are involved in coupon benefit calculation.
     *
     * @var object
     */
    public $request;

    /**
     * ApplyCoupon constructor.
     *
     * @param $request
     */
    public function __construct ($request)
    {
        $this->request = $request;
    }

    /**
     * Sets validate coupon flag to false.
     */
    public function bypassValidation ()
    {
        $this->validateCouponFlag = false;
    }

    /**
     * Starts coupon application process.
     *
     * @return object|bool
     */
    public function process ()
    {
        /**
         * Checks if validation is to be done for this coupon.
         *
         * If validation need to be done, then all
         * validations for the coupon are performed.
         *
         */
        if ( $this->validateCouponFlag && !$this->validate() ) return false;

        /**
         * Initializes coupon benefits.
         */
        $this->initialize();

        /**
         * Sets coupon benefits from offer.
         */
        $this->setCouponBenefits();

        return $this->request;
    }

    /**
     * Validation process.
     * @return bool
     */
    private function validate ()
    {
        /**
         * Validation data from coupon|campaign.
         */
        $campaignValidation = $this->getCouponData('validations');

        foreach ( $campaignValidation as $validation ) {
            $class = $validation->master->validation_class ?? ModelColumnCampaignValidation::class;
            $this->request = ( new $class($this->request, $validation) )->process();

            if ( !$this->request ) return false;
        }

        return true;
    }

    /**
     * Initializes data for benefits generation.
     */
    private function initialize ()
    {
        $this->request->coupon_benefits = [];
    }

    /**
     * Sets coupon benefits from offer.
     */
    private function setCouponBenefits ()
    {
        /**
         * Offer data from coupon|campaign.
         */
        $offers = $this->getOffers();

        foreach ( $offers as $offer ) {
            $class = $offer->offer_type->value;
            $this->request = ( new $class($this->request, $offer) )->process();
        }

        if ( empty($this->request->coupon_benefits) )
            unset($this->request->coupon_benefits);

        /**
         * Rounds off coupon benefit to higher value if property is set to 1.
         */
        if ( LaravelUtility::getProperty('round.off.coupon.benefit', 1) )
            $this->roundOffCouponBenefits();
    }

    /**
     * Get Offers
     *
     * @return array
     */
    public function getOffers ()
    {
        $data = $this->request->coupon->offers->where('validity', '>', DateUtil::getDateTime());
        if ( count($data) ) return $data;

        $data = $this->request->coupon->campaign->offers->where('validity', '>', DateUtil::getDateTime());

        return count($data) ? $data : [];
    }

    /**
     * Rounds off coupon benefit to higher value.
     */
    protected function roundOffCouponBenefits ()
    {
        foreach ( $this->request->coupon_benefits as $benefit => $amount )
            $this->request->coupon_benefits[ $benefit ] = ceil($amount);
    }
}
