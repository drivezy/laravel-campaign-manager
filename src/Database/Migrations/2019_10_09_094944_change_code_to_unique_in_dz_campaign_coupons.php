<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class ChangeCodeToUniqueInDzCampaignCoupons
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class ChangeCodeToUniqueInDzCampaignCoupons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('dz_campaign_coupons', function (Blueprint $table) {
            $table->unique('code');
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
            $table->dropUnique('code');
        });
    }
}
