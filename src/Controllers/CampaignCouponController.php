<?php

namespace Drivezy\LaravelMarketing\Controllers;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use  Drivezy\LaravelMarketing\Models\CampaignCoupon;

/**
 * Class CampaignCouponController
 * @package JRApp\Http\Controllers\Marketing
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignCouponController extends RecordController {
    /**
     * @var CampaignCoupon model path.
     */
    protected $model = CampaignCoupon::class;
}