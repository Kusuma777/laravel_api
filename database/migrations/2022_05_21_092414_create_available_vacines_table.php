<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailableVacinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('available_vacines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spot_id')->nullable();
            $table->boolean('sinovec')->default('1')->comment('1=tersedia , 0=tidak tersedia');
            $table->boolean('aztrazeneca')->default('1')->comment('1=tersedia , 0=tidak tersedia');
            $table->boolean('prifer')->default('1')->comment('1=tersedia , 0=tidak tersedia');
            $table->boolean('moderna')->default('1')->comment('1=tersedia , 0=tidak tersedia');
            $table->boolean('shinnopharm')->default('1')->comment('1=tersedia , 0=tidak tersedia');
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
        Schema::dropIfExists('available_vacines');
    }
}
