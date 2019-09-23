<?php

namespace Drivezy\LaravelCampaignManager\Controllers;

use Drivezy\LaravelCampaignManager\Models\CampaignOffer;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class CampaignOfferController
 * @package Drivezy\LaravelCampaignManager\Controllers
 * @author  Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignOfferController extends RecordController
{
    /**
     * @var CampaignOffer model path.
     */
    protected $model = CampaignOffer::class;
}
