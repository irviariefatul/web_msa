<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerhitunganGajisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perhitungan_gajis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger("allowance_id");
            $table->foreign('allowance_id')->references('id')->on('allowances')->onDelete('cascade');
            $table->unsignedBigInteger("qualification_id");
            $table->foreign('qualification_id')->references('id')->on('qualifications')->onDelete('cascade');
            $table->decimal('total_allowance', 10, 2);
            $table->decimal('total_gaji', 10, 2);
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
        Schema::dropIfExists('perhitungan_gajis');
    }
}
