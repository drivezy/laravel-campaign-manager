<?php

namespace Drivezy\LaravelCampaignManager\Models;

use Drivezy\LaravelCampaignManager\Observers\CampaignTermObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

/**
 * Class CampaignTerm
 * @package JRApp\Models\Marketing
 * @author  Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignTerm extends BaseModel
{
    /**
     * @var Campaign Term table.
     */
    protected $table = 'dz_campaign_terms';

    /**
     * Boot
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new CampaignTermObserver());
    }
}
