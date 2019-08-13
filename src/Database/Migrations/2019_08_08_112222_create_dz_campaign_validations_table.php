<?php

use Drivezy\LaravelUtility\LaravelUtility;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDzCampaignValidationsTable
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CreateDzCampaignValidationsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::create('dz_campaign_validations', function (Blueprint $table) {
            $userTable = LaravelUtility::getUserTable();

            $table->increments('id');
            $table->unsignedInteger('master_id')->comment('Reference on dz_campaign_validation_master')->nullable();

            $table->string('source_type')->comment('Validation source type')->nullable();
            $table->unsignedInteger('source_id')->comment('Validation source id')->nullable();

            $table->string('operator')->comment('Operator predicates')->nullable();
            $table->string('value')->comment('Operand for operation')->nullable();

            $table->string('error_message', 1024)->comment('Error message')->nullable();;

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('master_id')->references('id')->on('dz_campaign_validation_master');

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
        Schema::dropIfExists('dz_campaign_validations');
    }
}
