<?php

use Drivezy\LaravelUtility\LaravelUtility;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDzCampaignValidationMasterTable
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CreateDzCampaignValidationMasterTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::create('dz_campaign_validation_master', function (Blueprint $table) {
            $userTable = LaravelUtility::getUserTable();

            $table->increments('id');

            $table->string('name')->comment('Validation name')->nullable();
            $table->string('description')->comment('Validation description')->nullable();

            $table->string('validation_class')->comment('Validation class name')->nullable();

            $table->unsignedInteger('data_model_id')->comment('reference on dz_model_details')->nullable();
            $table->unsignedInteger('column_detail_id')->comment('reference on dz_column_details')->nullable();
            $table->unsignedInteger('custom_script_id')->comment('reference on dz_system_scripts')->nullable();

            $table->string('error_message', 1024)->comment('Error message')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('data_model_id')->references('id')->on('dz_model_details');
            $table->foreign('column_detail_id')->references('id')->on('dz_column_details');
            $table->foreign('custom_script_id')->references('id')->on('dz_system_scripts');

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
        Schema::dropIfExists('dz_campaign_validation_master');
    }
}
