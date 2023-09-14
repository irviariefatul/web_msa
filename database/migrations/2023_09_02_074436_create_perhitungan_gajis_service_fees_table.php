<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerhitunganGajisServiceFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perhitungan_gajis_service_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('perhitungan_gaji_id');
            $table->foreign('perhitungan_gaji_id')->references('id')->on('perhitungan_gajis')->onDelete('cascade');
            $table->unsignedBigInteger('service_fee_id');
            $table->foreign('service_fee_id')->references('id')->on('service_fees')->onDelete('cascade');
            $table->decimal('estimasi');
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
        Schema::dropIfExists('perhitungan_gajis_service_fees');
    }
}
