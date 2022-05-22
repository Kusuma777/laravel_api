<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationConsultations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->foreign('doctor_id')->references('id')->on('doctors')->noDelete('cascade');
            $table->foreign('society_id')->references('id')->on('societies')->noDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultations', function (Blueprint $table) {
        	$table->dropConstrainedForeignId('doctor_id');
        	$table->dropConstrainedForeignId('society_id');
        	$table->dropColumn(['docor_id', 'society_id']);
        });
    }
}
