<?php

namespace Drivezy\LaravelCampaignManager\Models;

use Drivezy\LaravelCampaignManager\Observers\CampaignValidationObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

/**
 * Class CampaignValidation
 * @package JRApp\Models\Marketing
 * @author  Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignValidation extends BaseModel
{
    /**
     * @var Campaign validation table.
     */
    protected $table = 'dz_campaign_validations';

    /**
     * Validation master.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function master ()
    {
        return $this->belongsTo(CampaignValidationMaster::class);
    }

    /**
     * Boot
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new CampaignValidationObserver());
    }
}
