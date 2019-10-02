<?php

namespace Drivezy\LaravelCampaignManager\Libraries;

use Drivezy\LaravelCampaignManager\Libraries\Validations\ModelColumnCampaignValidation;
use Drivezy\LaravelUtility\Facade\Message;
use Drivezy\LaravelUtility\LaravelUtility;
use Drivezy\LaravelUtility\Models\LookupValue;

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
         * Sets coupon benefits from offers.
         */
        $this->setBenefitsFromOffers();

        /**
         * Validate generated benefits.
         */
        if ( !$this->validateCouponBenefits() ) return;

        /**
         * Set description for coupon.
         */
        $this->setCouponDescription();

        /**
         * Rounds off coupon benefit to higher value if property is on.
         */
        if ( LaravelUtility::getProperty('round.off.coupon.benefit', 1) )
            $this->roundOffCouponBenefits();
    }


    /**
     * Sets coupon benefits from offers.
     */
    protected function setBenefitsFromOffers ()
    {
        $offerMapping = $this->validateCouponFlag ? 'valid_offers' : 'offers';

        /**
         * Offer data from coupon|campaign.
         */
        $offers = $this->getCouponData($offerMapping);

        foreach ( $offers as $offer ) {
            $class = $offer->offer_type->value;
            $this->request = ( new $class($this->request, $offer) )->process();
        }
    }

    /**
     * Validates generated benefits.
     */
    protected function validateCouponBenefits ()
    {
        $benefitHeads = LookupValue::where('lookup_type_id', LaravelUtility::getProperty('offer.nature.lookup.type'))->pluck('value')->toArray();
        foreach ( $benefitHeads as $benefitHead ) {
            if ( isset($this->request->coupon_benefits[ $benefitHead ]) && $this->request->coupon_benefits[ $benefitHead ] == 0 )
                unset($this->request->coupon_benefits[ $benefitHead ]);
        }

        if ( !empty($this->request->coupon_benefits) ) return true;

        /**
         * Sets invalid benefit error message.
         */
        return $this->setInvalidBenefitError();
    }

    /**
     * Return false after unseeting coupon benefits and giving error message.
     *
     * @return bool false
     */
    protected function setInvalidBenefitError ()
    {
        unset($this->request->coupon_benefits);

        Message::error('This coupon is not valid.');

        return false;
    }

    /**
     * Sets coupon description.
     */
    protected function setCouponDescription ()
    {
        $this->request->coupon_description = $this->request->coupon->description ? : $this->request->coupon->campaign->description;
    }

    /**
     * Rounds off coupon benefit.
     */
    protected function roundOffCouponBenefits ()
    {
        foreach ( $this->request->coupon_benefits as $benefit => $amount )
            $this->request->coupon_benefits[ $benefit ] = round($amount);
    }
}
