<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSapApplicationRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sap_application_role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sap_application_id');
            $table->foreign('sap_application_id')->references('id')->on('sap_applications');
            $table->unsignedBigInteger('sap_role_id');
            $table->foreign('sap_role_id')->references('id')->on('sap_roles');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('sap_application_role');
    }
}
