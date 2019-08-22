<?php

namespace Drivezy\LaravelCampaignManager\Controllers;

use Drivezy\LaravelCampaignManager\Models\CampaignValidationMaster;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class CampaignValidationMasterController
 * @package Drivezy\LaravelCampaignManager\Controllers
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignValidationMasterController extends RecordController {

    /**
     * @var CampaignValidationMaster model path.
     */
    protected $model = CampaignValidationMaster::class;
}
