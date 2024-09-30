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
        Schema::create('prokers', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->date('tanggal_mulai');
            $table->foreignId('periode_id')->constrained('periode')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('divisi_id')->nullable()->constrained('divisi')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prokers');
    }
};
