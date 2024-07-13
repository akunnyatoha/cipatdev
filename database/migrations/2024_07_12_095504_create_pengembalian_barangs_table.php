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
        Schema::create('pengembalian_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('code_peminjaman');
            $table->string('email');
            $table->string('phone');
            $table->string('name');
            $table->unsignedBigInteger('barang_id');
            $table->string('quantity');
            $table->string('description');
            $table->string('tgl_pengembalian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian_barangs');
    }
};
