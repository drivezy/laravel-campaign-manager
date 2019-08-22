<?php

namespace Drivezy\LaravelCampaignManager\Controllers;

use Drivezy\LaravelCampaignManager\Models\CampaignTerm;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class CampaignTermController
 * @package Drivezy\LaravelCampaignManager\Controllers
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignTermController extends RecordController {
    /**
     * @var CampaignTerm model path.
     */
    protected $model = CampaignTerm::class;
}
