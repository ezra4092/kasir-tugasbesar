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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->bigIncrements('idpenjualan');
            $table->date('tanggal')->nullable();
            $table->decimal('totalharga', 10, 2)->nullable();
            $table->unsignedBigInteger('idpelanggan');

            $table->foreign('idpelanggan')->references('idpelanggan')->on('pelanggan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
