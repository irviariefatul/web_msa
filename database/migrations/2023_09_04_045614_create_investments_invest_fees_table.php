<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentsInvestFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments_invest_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('investment_id');
            $table->foreign('investment_id')->references('id')->on('investments')->onDelete('cascade');
            $table->unsignedBigInteger('invest_fee_id');
            $table->foreign('invest_fee_id')->references('id')->on('invest_fees')->onDelete('cascade');
            $table->decimal('estimasi');
            $table->decimal('pemeliharaan_ivts', 14, 2);
            $table->decimal('biaya_pemeliharaan_ivts', 14, 2);
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
        Schema::dropIfExists('investments_invest_fees');
    }
}
