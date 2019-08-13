<?php

namespace Drivezy\LaravelMarketing\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class CampaignTermObserver
 * @package JRApp\Observers\Marketing
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignTermObserver extends BaseObserver {
    /**
     * @var array Required parameters.
     */
    protected $rules = [
        'valid_from' => 'required',
        'valid_to'   => 'required',
    ];
}