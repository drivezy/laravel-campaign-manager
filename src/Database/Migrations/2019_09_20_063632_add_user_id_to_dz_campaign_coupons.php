<?php

use Drivezy\LaravelUtility\LaravelUtility;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Adding user id to specify coupons for users.
 *
 * Class AddUserIdToDzCampaignCoupons
 */
class AddUserIdToDzCampaignCoupons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('dz_campaign_coupons', function (Blueprint $table) {
            $userTable = LaravelUtility::getUserTable();

            $table->unsignedInteger('user_id')->nullable()->comment('User against which coupon is valid.');
            $table->foreign('user_id')->references('id')->on($userTable);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::table('dz_campaign_coupons', function (Blueprint $table) {
            $table->dropForeign('dz_campaign_coupons_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
