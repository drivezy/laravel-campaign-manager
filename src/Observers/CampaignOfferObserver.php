<?php

namespace Drivezy\LaravelMarketing\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class CampaignOfferObserver
 * @package JRApp\Observers\Marketing
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignOfferObserver extends BaseObserver {
    /**
     * @var array Required parameters.
     */
    protected $rules = [
        'rate'           => 'required',
        'source_type'    => 'required',
        'source_id'      => 'required',
        'rate_nature_id' => 'required',
        'offer_type_id'  => 'required',
    ];
}