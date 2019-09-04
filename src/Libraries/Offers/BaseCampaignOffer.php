<?php

namespace Drivezy\LaravelCampaignManager\Libraries\Offers;

use Drivezy\LaravelCampaignManager\Models\CampaignOffer;
use Drivezy\LaravelUtility\Facade\Message;
use Drivezy\LaravelUtility\LaravelUtility;

/**
 * Class BaseCampaignOffer
 * @package Drivezy\LaravelCampaignManager\Libraries\Offer
 * @author  Yash Devkota <devkotayash4098@gmail.com>
 */
class BaseCampaignOffer
{
    /**
     * Offer mapped to coupon or its campaign.
     *
     * @var CampaignOffer
     */
    protected $offer;
    /**
     * Nature of offer.
     *
     * @var string
     */
    protected $offerNature = null;
    /**
     * Amount for which offer is to be calculated.
     *
     * @var int|float
     */
    protected $offerApplicableAmount = 0;
    /**
     * Pricing against which offer is to be applied.
     *
     * @var array
     */
    protected $offerApplicablePricing = [];
    /**
     * Contains data about pricing, coupon and other factors that are involved in coupon benefit calculation.
     *
     * @var object
     */
    public $request;

    /**
     * BaseOffer constructor.
     *
     * @param $request array
     * @param $offer   CampaignOffer
     */
    public function __construct ($request, CampaignOffer $offer)
    {
        $this->request = $request;
        $this->offer = $offer;
    }

    /**
     * Starts process for getting coupon benefits against offer.
     *
     * @return object
     */
    public function process ()
    {
        /**
         * Sets pricing for which offer is applicable.
         */
        $this->setOfferApplicablePricing();

        /**
         * Checks if offer is valid.
         */
        if ( $this->isOfferValid() ) {

            /**
             * Sets benefits gained from offer.
             */
            $this->setBenefit();
        }

        return $this->request;
    }

    /**
     * Sets pricing for which offer is applicable.
     */
    protected function setOfferApplicablePricing ()
    {
        $offerApplicableAccountHeads = explode(',', LaravelUtility::getProperty('offer.applicable.account.heads'));

        foreach ( $this->request->pricing as $accountHead => $amount ) {
            if ( in_array($accountHead, $offerApplicableAccountHeads) ) {
                $this->offerApplicablePricing[ $accountHead ] = $amount;
                $this->offerApplicableAmount += $amount;
            }
        }
    }

    /**
     * Checks if offer is valid or not.
     *
     * @return bool
     */
    protected function isOfferValid ()
    {
        $valid = $this->offerApplicableAmount >= $this->offer->minimum_order_amount;

        if ( !$valid ) Message::error("Minimum booking amount of Rs. {$this->offer->minimum_order_amount} is required.");

        return $valid;
    }

    /**
     * Sets offer benefit.
     */
    protected function setBenefit ()
    {

        /**
         * Sets nature of the offer.
         *
         * The nature of offer is also
         * the key against which the
         * benefit will be stored.
         */
        $this->setOfferNature();

        /**
         * Initializes benefit if
         * it is not already set.
         */
        $this->initializeBenefit();

        /**
         * Sets offer value to benefit
         */
        $this->setOfferValue();
    }

    /**
     * Sets the nature of the offer.
     *
     * The value of the lookup for the
     * rate nature corresponds to
     * the benefit category.
     */
    protected function setOfferNature ()
    {
        $this->offerNature = $this->offer->rate_nature->value;
    }

    /**
     * Initializes benefits if it is not initialized against the offer nature.
     */
    protected function initializeBenefit ()
    {
        if ( !isset($this->request->coupon_benefits[ $this->offerNature ]) )
            $this->request->coupon_benefits[ $this->offerNature ] = 0;
    }

    /**
     * Sets offer value
     *
     * This method is to be overwritten in child classes if offer benefit needs to be calculated.
     *
     */
    protected function setOfferValue ()
    {
        $this->request->coupon_benefits[ $this->offerNature ] = $this->offer->rate;
    }
}
