<?php

namespace JRApp\Http\Controllers\Marketing;

use Drivezy\LaravelMarketing\Models\CampaignValidationMaster;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class CampaignValidationMasterController
 * @package JRApp\Http\Controllers\Marketing
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignValidationMasterController extends RecordController {
    /**
     * @var CampaignValidationMaster model path.
     */
    protected $model = CampaignValidationMaster::class;
}