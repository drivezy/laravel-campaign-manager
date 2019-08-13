<?php

namespace JRApp\Http\Controllers\Marketing;

use Drivezy\LaravelMarketing\Models\CampaignOffer;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class CampaignOfferController
 * @package JRApp\Http\Controllers\Marketing
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignOfferController extends RecordController {
    /**
     * @var CampaignOffer model path.
     */
    protected $model = CampaignOffer::class;
}