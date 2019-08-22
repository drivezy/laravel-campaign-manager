<?php

use Drivezy\LaravelUtility\LaravelUtility;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDzCampaignCouponsTable
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CreateDzCampaignCouponsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::create('dz_campaign_coupons', function (Blueprint $table) {
            $userTable = LaravelUtility::getUserTable();

            $table->bigIncrements('id');
            $table->unsignedInteger('campaign_id')->comment('Reference on dz_campaign_details')->nullable();

            $table->string('code')->comment('Coupon code')->nullable();
            $table->unsignedInteger('coupon_type_id')->comment('Type of coupon')->nullable();
            $table->string('description')->comment('Coupon description')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('campaign_id')->references('id')->on('dz_campaign_details');
            $table->foreign('coupon_type_id')->references('id')->on('dz_lookup_values');

            $table->foreign('created_by')->references('id')->on($userTable);
            $table->foreign('updated_by')->references('id')->on($userTable);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::dropIfExists('dz_campaign_coupons');
    }
}
