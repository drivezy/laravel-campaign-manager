<?php

namespace JRApp\Http\Controllers\Marketing;

use Drivezy\LaravelMarketing\Models\CampaignValidation;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class CampaignValidationController
 * @package JRApp\Http\Controllers\Marketing
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignValidationController extends RecordController {
    /**
     * @var CampaignValidation model path.
     */
    protected $model = CampaignValidation::class;
}