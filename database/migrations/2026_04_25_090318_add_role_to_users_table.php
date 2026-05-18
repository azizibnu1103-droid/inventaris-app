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
        Schema::table('users', function (Blueprint $table) {

            // Cek apakah kolom role belum ada
            // supaya tidak duplicate saat deploy/redeploy
            if (!Schema::hasColumn('users', 'role')) {

                $table->string('role')
                    ->default('user');

            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Hapus kolom role jika ada
            if (Schema::hasColumn('users', 'role')) {

                $table->dropColumn('role');

            }

        });
    }
};