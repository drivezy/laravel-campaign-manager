<?php

namespace Drivezy\LaravelCampaignManager\Controllers;

use Drivezy\LaravelCampaignManager\Models\CampaignValidation;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class CampaignValidationController
 * @package Drivezy\LaravelCampaignManager\Controllers
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignValidationController extends RecordController {
    /**
     * @var CampaignValidation model path.
     */
    protected $model = CampaignValidation::class;
}
