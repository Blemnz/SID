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
        Schema::create('sids', function (Blueprint $table) {
            $table->string('id');
            $table->integer('register');
            $table->string('originating');
            $table->string('terminating');
            $table->string('service');
            $table->string('bulan');
            $table->string('tahun');
            $table->enum('status', ['pending', 'selesai'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sids');
    }
};
