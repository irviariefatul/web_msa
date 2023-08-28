<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllowancePerhitunganGajisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allowance_perhitungan_gajis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('allowance_id');
            $table->unsignedBigInteger('perhitungan_gaji_id');
            $table->timestamps();

            $table->foreign('allowance_id')->references('id')->on('allowances')->onDelete('cascade');
            $table->foreign('perhitungan_gaji_id')->references('id')->on('perhitungan_gajis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allowance_perhitungan_gajis');
    }
}
