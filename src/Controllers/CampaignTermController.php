<?php

namespace JRApp\Http\Controllers\Marketing;

use Drivezy\LaravelMarketing\Models\CampaignTerm;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class CampaignTermController
 * @package JRApp\Http\Controllers\Marketing
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignTermController extends RecordController {
    /**
     * @var CampaignTerm model path.
     */
    protected $model = CampaignTerm::class;
}