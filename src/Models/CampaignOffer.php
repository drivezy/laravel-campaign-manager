<?php

namespace Drivezy\LaravelCampaignManager\Models;

use Drivezy\LaravelCampaignManager\Observers\CampaignOfferObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelUtility\Models\LookupValue;

/**
 * Class CampaignOffer
 * @package JRApp\Models\Marketing
 * @author  Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignOffer extends BaseModel
{
    /**
     * @var Campaign offers table.
     */
    protected $table = 'dz_campaign_offers';


    /**
     * Nature of offer.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rate_nature ()
    {
        return $this->belongsTo(LookupValue::class);
    }

    /**
     * Type of offer.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offer_type ()
    {
        return $this->belongsTo(LookupValue::class);
    }

    /**
     * Boot
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new CampaignOfferObserver());
    }
}
