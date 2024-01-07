<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesforceApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesforce_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('account_application_id');
            $table->foreign('account_application_id')->references('id')->on('account_applications')->onDelete('cascade');
            $table->json('salesforce_profiles');
            $table->json('profiles_for_delete')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salesforce_applications');
    }
}
