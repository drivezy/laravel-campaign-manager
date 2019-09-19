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

        $validation = new CampaignValidation();
        $validation->master_id = $master->id;
        $validation->source_type = $model->source_type;
        $validation->source_id = $model->source_id;
        $validation->operator = 'eq';
        $validation->value = 1;
        $validation->error_message = $master->error_message;
        $validation->save();
    }
}
