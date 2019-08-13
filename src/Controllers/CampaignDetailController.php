<?php

namespace JRApp\Http\Controllers\Marketing;

use Drivezy\LaravelMarketing\Models\CampaignDetail;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class CampaignDetailController
 * @package JRApp\Http\Controllers\Marketing
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignDetailController extends RecordController {
    /**
     * @var CampaignDetail model path.
     */
    protected $model = CampaignDetail::class;
}