<?php

namespace Drivezy\LaravelCampaignManager\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class CampaignDetailObserver
 * @package Drivezy\LaravelCampaignManager\Observers
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignDetailObserver extends BaseObserver {
    /**
     * @var array Required parameters.
     */
    protected $rules = [
        'name'        => 'required',
        'description' => 'required',
    ];
}
