<?php

namespace Drivezy\LaravelMarketing\Libraries\Validations;


/**
 * Class AgeCampaignValidation
 * @package Drivezy\LaravelMarketing\Libraries\Validations
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class AgeCampaignValidation extends BaseCampaignValidation {

    /**
     * Sets operand for comparision.
     */
    protected function setOperand () {
        $this->operand = $this->user->age;
    }
}