<?php

namespace Drivezy\LaravelMarketing\Models;

use Drivezy\LaravelMarketing\Observers\CampaignDetailObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

/**
 * Class CampaignDetail
 * @package JRApp\Models\Marketing
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignDetail extends BaseModel {
    /**
     * @var Campaign details table.
     */
    protected $table = 'dz_campaign_details';

    /**
     * Validations set against campaign.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function validations () {
        return $this->hasMany(CampaignValidation::class, 'source_id', 'id')->where('source_type',  md5(self::class));
    }

    /**
     * Offers set against campaign.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers () {
        return $this->hasMany(CampaignOffer::class, 'source_id', 'id')->where('source_type',  md5(self::class));
    }

    /**
     * Terms set against campaign.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function term () {
        return $this->hasMany(CampaignTerm::class, 'source_id', 'id')->where('source_type',  md5(self::class));
    }

    /**
     * Campaign coupons.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coupons () {
        return $this->hasMany(CampaignCoupon::class, 'campaign_id', 'id');
    }

    /**
     * Boot
     */
    public static function boot () {
        parent::boot();
        self::observe(new CampaignDetailObserver());
    }
}