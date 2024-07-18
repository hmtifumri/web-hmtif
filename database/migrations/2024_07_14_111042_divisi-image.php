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
        Schema::create('divisi-image', function (Blueprint $table) {
            $table->id();
            $table->foreignId('divisi_id')->constrained('divisi')->onUpdate('cascade')->onDelete('cascade');
            $table->string('image');
            $table->foreignId('periode_id')->constrained('periode')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisi-image');
    }
};
