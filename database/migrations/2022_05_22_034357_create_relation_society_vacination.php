<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationSocietyVacination extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('society_vacinations', function (Blueprint $table) {
            $table->foreign('spot_id')->references('id')->on('spots')->noDelete('cascade');
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
        Schema::table('society_vacination', function (Blueprint $table) {
        	$table->dropConstrainedForeignId('spot_id');
        	$table->dropConstrainedForeignId('society_id');
        	$table->dropColumn(['spot_id', 'society_id']);
        });
    }
}
