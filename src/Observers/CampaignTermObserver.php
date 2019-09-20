<?php

namespace Drivezy\LaravelCampaignManager\Observers;

use Drivezy\LaravelCampaignManager\Libraries\Validations\TermCampaignValidation;
use Drivezy\LaravelCampaignManager\Models\CampaignValidation;
use Drivezy\LaravelCampaignManager\Models\CampaignValidationMaster;
use Drivezy\LaravelUtility\Observers\BaseObserver;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class CampaignTermObserver
 * @package Drivezy\LaravelCampaignManager\Observers
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignTermObserver extends BaseObserver
{

    /**
     * @var array Required parameters.
     */
    protected $rules = [
        'valid_from' => 'required',
        'valid_to'   => 'required',
    ];

    /**
     * @param Eloquent $model
     */
    public function created (Eloquent $model)
    {
        parent::created($model);
        if ( !$model->source_type || !$model->source_id ) return;

        $master = CampaignValidationMaster::where('validation_class', TermCampaignValidation::class)->first();

        CampaignValidation::firstOrCreate([
            'source_type'   => $model->source_type,
            'source_id'     => $model->source_id,
            'value'         => 1,
            'operator'      => 'eq',
            'master_id'     => $master->id,
            'error_message' => $master->error_message,
        ]);
    }
}
