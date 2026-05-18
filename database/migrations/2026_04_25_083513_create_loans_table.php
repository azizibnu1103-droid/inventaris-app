<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Menghubungkan ke tabel items (INI YANG ERROR TADI)
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->integer('jumlah');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali')->nullable();
            $table->string('status')->default('dipinjam');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};