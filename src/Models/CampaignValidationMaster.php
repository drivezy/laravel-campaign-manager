<?php

namespace Drivezy\LaravelCampaignManager\Models;

use Drivezy\LaravelCampaignManager\Observers\CampaignValidationMasterObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelRecordManager\Models\Column;
use Drivezy\LaravelRecordManager\Models\DataModel;
use Drivezy\LaravelRecordManager\Models\SystemScript;

/**
 * Class CampaignValidationMaster
 * @package JRApp\Models\Marketing
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignValidationMaster extends BaseModel {
    /**
     * @var Campaign validation master table.
     */
    protected $table = 'dz_campaign_validation_master';

    /**
     * Model against which validation is created.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function data_model () {
        return $this->belongsTo(DataModel::class);
    }

    /**
     * Column against which validation is created.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function column_detail () {
        return $this->belongsTo(Column::class);
    }

    /**
     * Custom script against which validation is created.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function custom_script () {
        return $this->belongsTo(SystemScript::class);
    }

    /**
     * Boot
     */
    public static function boot () {
        parent::boot();
        self::observe(new CampaignValidationMasterObserver());
    }
}
