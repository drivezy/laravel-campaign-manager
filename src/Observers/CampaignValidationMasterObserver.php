<?php

namespace Drivezy\LaravelCampaignManager\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class CampaignValidationMasterObserver
 * @package Drivezy\LaravelCampaignManager\Observers
 * @author  Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignValidationMasterObserver extends BaseObserver
{
    /**
     * Required parameters.
     *
     * @var array
     */
    protected $rules = [
        'name'             => 'required',
        'description'      => 'required',
        'validation_class' => 'required',
    ];
}
