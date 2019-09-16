<?php

use Drivezy\LaravelUtility\LaravelUtility;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDzCampaignDetailsTable
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CreateDzCampaignDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('dz_campaign_details', function (Blueprint $table)
        {
            $userTable = LaravelUtility::getUserTable();

            $table->bigIncrements('id');

            $table->string('name')->comment('Campaign name')->nullable();
            $table->string('description')->comment('Campaign description')->nullable();

            $table->string('campaign_class')->comment('Class for divergent campaigns')->nullable();

            $table->unsignedDecimal('budget', 10, 3)->comment('Maximum budget')->nullable();

            $table->boolean('active')->comment('Active flag')->nullable();
            $table->boolean('reusable')->comment('Reusable flag')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on($userTable);
            $table->foreign('updated_by')->references('id')->on($userTable);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists('dz_campaign_details');
    }
}
