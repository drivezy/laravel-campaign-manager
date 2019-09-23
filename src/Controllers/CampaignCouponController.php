<?php

namespace Drivezy\LaravelCampaignManager\Controllers;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use  Drivezy\LaravelCampaignManager\Models\CampaignCoupon;

/**
 * Class CampaignCouponController
 * @package Drivezy\LaravelCampaignManager\Controllers
 * @author  Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignCouponController extends RecordController
{
    /**
     * @var CampaignCoupon model path.
     */
    protected $model = CampaignCoupon::class;
}
