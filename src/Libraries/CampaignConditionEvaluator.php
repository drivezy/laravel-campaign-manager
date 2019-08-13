<?php

namespace Drivezy\LaravelMarketing\Libraries;

use Drivezy\LaravelMarketing\Models\CampaignValidation;

/**
 * Class CampaignConditionEvaluator
 *
 * For any statement <X> <OPERATOR> <Y>
 * X is the operand
 * <OPERATOR> is taken from CampaignValidation. Each type of operator is defined by a method.
 * <Y> is comparision value taken from CampaignValidation.
 *
 * @package Drivezy\LaravelMarketing\Libraries
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignConditionEvaluator {

    /**
     * CampaignValidation
     *
     * @var object
     */
    private $validation = null;
    /**
     * Operand against which validation is to be performed.
     *
     * @var string/boolean/float
     */
    private $operand = null;

    /**
     * CampaignConditionEvaluator constructor.
     *
     * @param CampaignValidation $validation
     * @param $operand operand against whom operation is evaluated.
     */
    public function __construct (CampaignValidation $validation, $operand) {
        $this->validation = $validation;
        $this->operand = $operand;
    }

    /**
     * Checks if operand is equal to given value.
     *
     * @return bool
     */
    public function eq () {
        return ( $this->operand == $this->validation->value );
    }

    /**
     * Checks if operand is not equal to given value.
     *
     * @return bool
     */
    public function ne () {
        return ( $this->operand != $this->validation->value );
    }

    /**
     * Checks if operand is greater than given value.
     *
     * @return bool
     */
    public function gt () {
        return ( $this->operand > $this->validation->value );
    }

    /**
     * Checks if operand is less than given value.
     *
     * @return bool
     */
    public function lt () {
        return ( $this->operand < $this->validation->value );
    }

    /**
     * Checks if operand is greater than or equal to given value.
     *
     * @return bool
     */
    public function ge () {
        return ( $this->operand >= $this->validation->value );
    }

    /**
     * Checks if operand is less than or equal to given value.
     *
     * @return bool
     */
    public function le () {
        return ( $this->operand <= $this->validation->value );
    }

    /**
     * Checks if operand is among given values.
     *
     * @return bool
     */
    public function in () {
        return in_array($this->operand, explode(',', $this->validation->value));
    }
}