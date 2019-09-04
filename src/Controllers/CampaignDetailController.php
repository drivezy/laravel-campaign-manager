<?php

namespace Drivezy\LaravelCampaignManager\Controllers;

use Drivezy\LaravelCampaignManager\Models\CampaignDetail;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class CampaignDetailController
 * @package Drivezy\LaravelCampaignManager\Controllers
 * @author  Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignDetailController extends RecordController
{
    /**
     * @var CampaignDetail model path.
     */
    protected $model = CampaignDetail::class;
}
