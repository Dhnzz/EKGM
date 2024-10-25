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
        Schema::create('periksa_gigis', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('result');
            $table->string('image');
            $table->integer('ohis')->nullable();
            $table->foreignId('responden_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periksa_gigis');
    }
};
