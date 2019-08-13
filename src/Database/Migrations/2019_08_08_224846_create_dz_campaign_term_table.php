<?php

use Drivezy\LaravelUtility\LaravelUtility;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDzCampaignTermTable
 */
class CreateDzCampaignTermTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     * @author Yash Devkota <devkotayash4098@gmail.com>
     */
    public function up () {
        Schema::create('dz_campaign_term', function (Blueprint $table) {
            $userTable = LaravelUtility::getUserTable();

            $table->increments('id');

            $table->string('source_type')->comment('Term source type');
            $table->unsignedInteger('source_id')->comment('Term source id');

            $table->dateTime('start_time')->comment('Asset start time')->nullable();
            $table->dateTime('end_time')->comment('Asset end time.')->nullable();

            $table->dateTime('valid_from')->comment('Campaign start time')->nullable();
            $table->dateTime('valid_to')->comment('Campaign end time')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on($userTable);
            $table->foreign('updated_by')->references('id')->on($userTable);

            $table->index(['source_type', 'source_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::dropIfExists('dz_campaign_term');
    }
}
