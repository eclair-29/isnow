<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSapApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sap_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('account_application_id');
            $table->foreign('account_application_id')->references('id')->on('account_applications');
            $table->string('notes')->nullable();
            $table->json('sap_roles');
            $table->json('roles_for_delete')->nullable();
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
        Schema::dropIfExists('sap_applications');
    }
}
