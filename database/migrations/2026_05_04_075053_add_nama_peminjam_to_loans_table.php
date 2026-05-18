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

            // Cegah duplicate column saat deploy
            if (!Schema::hasColumn('loans', 'nama_peminjam')) {

                $table->string('nama_peminjam');

            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {

            if (Schema::hasColumn('loans', 'nama_peminjam')) {

                $table->dropColumn('nama_peminjam');

            }

        });
    }
};