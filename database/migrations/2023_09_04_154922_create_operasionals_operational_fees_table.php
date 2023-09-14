<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperasionalsOperationalFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operasionals_operational_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('operasional_id');
            $table->foreign('operasional_id')->references('id')->on('operasionals')->onDelete('cascade');
            $table->unsignedBigInteger('operational_fee_id');
            $table->foreign('operational_fee_id')->references('id')->on('operational_fees')->onDelete('cascade');
            $table->decimal('estimasi');
            $table->decimal('pemeliharaan_opts', 14, 2);
            $table->decimal('biaya_pemeliharaan_opts', 14, 2);
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
        Schema::dropIfExists('operasionals_operational_fees');
    }
}
