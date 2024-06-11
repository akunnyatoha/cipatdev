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
        Schema::create('peminjaman_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('barang_id');
            $table->text('description');
            $table->timestamp('start_datetime')->nullable(); // Tanggal dan waktu mulai peminjaman
            $table->timestamp('end_datetime')->nullable();   // Tanggal dan waktu selesai peminjaman
            $table->string('quantity');
            $table->enum('status', ['accepted', 'pending', 'reject'])->default('pending');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('validated_by')->nullable();
            $table->timestamps();
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('validated_by')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_barangs');
    }
};
