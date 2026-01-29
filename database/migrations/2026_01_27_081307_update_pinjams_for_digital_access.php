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
       Schema::table('pinjams', function (Blueprint $table) {

    // hapus kolom lama
    $table->dropColumn([
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_dikembalikan',
        'status',
    ]);

    // kolom baru (PERHATIKAN nullable())
    $table->timestamp('mulai_akses')->nullable()->after('book_id');
    $table->timestamp('berakhir_pada')->nullable()->after('mulai_akses');

    $table->enum('status', ['aktif', 'selesai'])
          ->default('aktif')
          ->after('berakhir_pada');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
