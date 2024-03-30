<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detailpenjualan', function (Blueprint $table) {
            $table->bigIncrements('iddetail');
            $table->unsignedBigInteger('idpenjualan');
            $table->unsignedBigInteger('idproduk');
            $table->integer('jumlahproduk');
            $table->decimal('subtotal', 10,2);

            $table->foreign('idpenjualan')->references('idpenjualan')->on('penjualan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailpenjualan');
    }
};
