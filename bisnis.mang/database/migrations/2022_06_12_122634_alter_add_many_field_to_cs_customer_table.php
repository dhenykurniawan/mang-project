<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddManyFieldToCsCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cs_customer', function (Blueprint $table) {
            $table->string('customer_nama_pic')->after('customer_email')->nullable();
            $table->string('customer_jenis_usaha')->after('customer_nama_pic')->nullable();
            $table->string('customer_alamat_usaha')->after('customer_jenis_usaha')->nullable();
            $table->string('customer_jam_operasional')->after('customer_alamat_usaha')->nullable();
            $table->string('customer_jam_pengiriman')->after('customer_jam_operasional')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cs_customer', function (Blueprint $table) {
            $table->dropColumn('customer_nama_pic');
            $table->dropColumn('customer_jenis_usaha');
            $table->dropColumn('customer_alamat_usaha');
            $table->dropColumn('customer_jam_operasional');
            $table->dropColumn('customer_jam_pengiriman');
        });
    }
}
