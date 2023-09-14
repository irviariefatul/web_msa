<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalBiayaPemeliharaanToInvestFees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        Schema::table('invest_fees', function (Blueprint $table) {
            $table->decimal('total_biaya_invest', 14, 2)->after('layanan');
            $table->decimal('total_biaya_pemeliharaan', 14, 2)->after('total_biaya_invest');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invest_fees', function (Blueprint $table) {
            $table->dropColumn('total_biaya_invest');
            $table->dropColumn('total_biaya_pemeliharaan');
        });
    }
}
