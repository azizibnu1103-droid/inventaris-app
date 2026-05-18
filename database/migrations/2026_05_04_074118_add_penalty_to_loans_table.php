<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            // Mengecek apakah kolom sudah ada sebelum membuatnya
            if (!Schema::hasColumn('loans', 'nama_peminjam')) {
                $table->string('nama_peminjam')->nullable();
            }
            
            if (!Schema::hasColumn('loans', 'tgl_kembali_seharusnya')) {
                $table->date('tgl_kembali_seharusnya')->nullable();
            }
            
            if (!Schema::hasColumn('loans', 'denda')) {
                $table->integer('denda')->default(0);
            }
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            if (Schema::hasColumn('loans', 'nama_peminjam')) {
                $table->dropColumn('nama_peminjam');
            }
            if (Schema::hasColumn('loans', 'tgl_kembali_seharusnya')) {
                $table->dropColumn('tgl_kembali_seharusnya');
            }
            if (Schema::hasColumn('loans', 'denda')) {
                $table->dropColumn('denda');
            }
        });
    }
};