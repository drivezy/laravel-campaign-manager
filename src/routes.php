<?php

Route::group(['namespace' => 'Drivezy\LaravelCampaignManager\Controllers',
              'prefix'    => 'api/record'], function ()
{

    Route::resource('coupon', 'CampaignCouponController');
    Route::resource('campaign', 'CampaignDetailController');
    Route::resource('offer', 'CampaignOfferController');
    Route::resource('term', 'CampaignTermController');
    Route::resource('validation', 'CampaignValidationController');
    Route::resource('validationMaster', 'CampaignValidationMasterController');

});