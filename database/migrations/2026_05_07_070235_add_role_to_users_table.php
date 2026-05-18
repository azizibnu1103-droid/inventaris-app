<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Cek dan tambah kolom role di tabel users
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('guru')->after('password');
            });
        }

        // 2. Cek dan tambah kolom image di tabel items
        if (!Schema::hasColumn('items', 'image')) {
            Schema::table('items', function (Blueprint $table) {
                $table->string('image')->nullable()->after('nama_barang');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }

        if (Schema::hasColumn('items', 'image')) {
            Schema::table('items', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
    }
};