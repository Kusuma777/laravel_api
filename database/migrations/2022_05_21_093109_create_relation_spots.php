<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationSpots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('available_vacines', function (Blueprint $table) {
            $table->foreign('spot_id')->references('id')->on('spots')->noDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('available_vacine', function (Blueprint $table) {
        	$table->dropConstrainedForeignId('spot_id');
        	$table->dropColumn(['spot_id']);
        });
    }
}
