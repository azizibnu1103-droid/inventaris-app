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
    Schema::table('loans', function (Blueprint $table) {
        // Tambahkan kolom nama_peminjam (bisa dikosongkan untuk data lama agar tidak error)
        $table->string('nama_peminjam')->nullable()->after('item_id');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            //
        });
    }
};
