<?php

use Drivezy\LaravelUtility\LaravelUtility;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDzCampaignOffersTable
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class CreateDzCampaignOffersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::create('dz_campaign_offers', function (Blueprint $table) {
            $userTable = LaravelUtility::getUserTable();

            $table->bigIncrements('id');

            $table->string('source_type')->comment('Offer source type')->nullable();
            $table->unsignedInteger('source_id')->comment('Offer source id')->nullable();

            $table->unsignedDecimal('rate', 10, 3)->comment('Offer rate')->nullable();
            $table->unsignedInteger('rate_nature_id')->comment('Rate nature')->nullable();

            $table->unsignedDecimal('minimum_order_amount', 10, 3)->default(0)->comment('Minimum order amount for offer to be applicable');
            $table->unsignedDecimal('maximum_offer_value', 10, 3)->comment('Maximum offer value.')->nullable();

            $table->dateTime('validity')->comment('Offer validity')->nullable();
            $table->unsignedInteger('offer_type_id')->comment('Type of offer referencing dz_lookup_values')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('offer_type_id')->references('id')->on('dz_lookup_values');
            $table->foreign('rate_nature_id')->references('id')->on('dz_lookup_values');

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
        Schema::dropIfExists('dz_campaign_offers');
    }
}
