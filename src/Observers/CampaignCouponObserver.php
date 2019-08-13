<?php

namespace Drivezy\LaravelMarketing\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class CampaignCouponObserver
 * @package JRApp\Observers\Marketing
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignCouponObserver extends BaseObserver {
    /**
     * @var array Required parameters.
     */
    protected $rules = [
        'campaign_id' => 'required',
        'code'        => 'required',
    ];
}