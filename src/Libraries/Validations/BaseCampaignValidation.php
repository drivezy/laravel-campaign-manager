<?php

namespace Drivezy\LaravelMarketing\Libraries\Validations;

use Drivezy\LaravelMarketing\Libraries\CampaignConditionEvaluator;
use Drivezy\LaravelMarketing\Models\CampaignValidation;
use Illuminate\Support\Facades\Auth;
use Drivezy\LaravelUtility\Facade\Message;

/**
 * Class BaseCampaignValidation
 * @package Drivezy\LaravelMarketing\Libraries\Validations
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class BaseCampaignValidation {
    /**
     * CampaignValidation
     *
     * @var object
     */
    protected $validation;
    /**
     * Operand against which validation will be performed.
     *
     * @var string/float/bool
     */
    protected $operand = null;
    /**
     * User against which validation for campaign is done.
     *
     * @var object
     */
    protected $user = null;
    /**
     * Contains data about pricing, coupon and other factors that are involved in coupon benefit calculation.
     *
     * @var object
     */
    public $request = null;

    /**
     * BaseCampaignValidation constructor.
     * @param $request
     * @param CampaignValidation $validation
     */
    public function __construct ($request, CampaignValidation $validation) {
        $this->request = $request;
        $this->validation = $validation;
    }

    /**
     * Processes validation.
     *
     * If validation is successful, it will return updated request.
     * If validation is unsuccessful, it will return null.
     *
     * @return object
     */
    public function process () {
        /**
         * Sets user details
         */
        $this->setUserDetails();

        /**
         * Sets operand against which validation is to be performed.
         */
        $this->setOperand();

        /**
         * Checks if campaign is valid.
         */
        if ( !$this->isCampaignValid() ) {

            /**
             * Sends campaign error message.
             */
            $this->error();
        }

        return $this->request;
    }

    /**
     * Sets user details from Auth if user details are not provided in request.
     */
    protected function setUserDetails () {
        $this->user = $this->request->user ?? Auth::user();
    }

    /**
     * This method is to be overwritten in child class.
     * This method will contain all validation code.
     */
    private function isCampaignValid () {
        return ( new CampaignConditionEvaluator($this->validation, $this->operand) )->{$this->validation->operator}();
    }

    /**
     * This sets the error message. It also sets the $this->response to false.
     */
    private function error () {
        Message::error($this->validation->error_message ? : $this->validation->master->error_message);

        $this->request = false;
    }

    /**
     * This method is to be overwritten in all child classes.
     */
    protected function setOperand () {
    }
}