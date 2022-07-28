<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrProdukVariantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_produk_variant', function (Blueprint $table) {
            $table->id('produk_variant_id');
            $table->foreignId('pr__produk_produk_id');
            $table->string('produk_variant_nama');
            $table->string('produk_variant_shortdesc');
            $table->text('produk_variant_desc')->nullable();
            $table->bigInteger('produk_variant_harga_beli')->nullable();
            $table->bigInteger('produk_variant_harga_jual')->nullable();
            $table->bigInteger('produk_variant_harga_promo')->nullable();
            $table->boolean('produk_variant_status')->default(true);
            $table->boolean('produk_variant_someday')->default(true);
            $table->text('produk_variant_gambar')->nullable();
            $table->integer('produk_variant_createdby')->nullable();
            $table->integer('produk_variant_updatedby')->nullable();
            $table->timestamp('produk_variant_created')->useCurrent();
            $table->timestamp('produk_variant_updated')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pr_produk_variant');
    }
}
