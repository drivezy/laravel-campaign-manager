<?php

namespace Drivezy\LaravelCampaignManager\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class CampaignTermObserver
 * @package Drivezy\LaravelCampaignManager\Observers
 * @author  Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignTermObserver extends BaseObserver
{
    /**
     * Required parameters.
     *
     * @var array
     */
    protected $rules = [
        'valid_from' => 'required',
        'valid_to'   => 'required',
    ];
}
