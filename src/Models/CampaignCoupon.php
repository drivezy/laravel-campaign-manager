<?php

namespace Drivezy\LaravelCampaignManager\Models;

use Drivezy\LaravelCampaignManager\Observers\CampaignCouponObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

/**
 * Class CampaignCoupon
 * @package JRApp\Models\Marketing
 * @author  Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignCoupon extends BaseModel
{
    /**
     * @var Campaign coupons table.
     */
    protected $table = 'dz_campaign_coupons';

    /**
     * Validations set against coupon.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function validations ()
    {
        return $this->hasMany(CampaignValidation::class, 'source_id')->where('source_type', md5(self::class));
    }

    /**
     * Offers set against coupon.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers ()
    {
        return $this->hasMany(CampaignOffer::class, 'source_id')->where('source_type', md5(self::class));
    }

    /**
     * Term set against coupon.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function term ()
    {
        return $this->hasMany(CampaignTerm::class, 'source_id')->where('source_type', md5(self::class));
    }

    /**
     * Coupon campaign.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campaign ()
    {
        return $this->belongsTo(CampaignDetail::class);
    }

    /**
     * Boot
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new CampaignCouponObserver());
    }
}
