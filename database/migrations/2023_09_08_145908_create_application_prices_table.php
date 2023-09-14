<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('service_fee_id');
            $table->foreign('service_fee_id')->references('id')->on('service_fees')->onDelete('cascade');
            $table->unsignedBigInteger('invest_fee_id');
            $table->foreign('invest_fee_id')->references('id')->on('invest_fees')->onDelete('cascade');
            $table->unsignedBigInteger('operational_fee_id');
            $table->foreign('operational_fee_id')->references('id')->on('operational_fees')->onDelete('cascade');
            $table->decimal('total_biaya_pemeliharaan', 14, 2)->default(0);
            $table->decimal('total_biaya_kebutuhan', 14, 2); 
            $table->decimal('estimasi_bulan');
            $table->decimal('estimasi_user');
            $table->decimal('harga_aplikasi', 14, 2);
            $table->decimal('persentase_biaya_admin');
            $table->decimal('biaya_admin', 14, 2);
            $table->decimal('total_harga_aplikasi', 14, 2);
            $table->decimal('jumlah_pemasukan', 14, 2);
            $table->decimal('jumlah_keuntungan', 14, 2);
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
        Schema::dropIfExists('application_prices');
    }
}
