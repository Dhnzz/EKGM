<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('responden_id')->constrained()->onDelete('cascade');
            $table->foreignId('tb_question_id')->constrained()->onDelete('cascade');
            $table->text('answer_text')->nullable();
            $table->integer('answer_integer')->nullable();
            $table->boolean('answer_boolean')->nullable();
            $table->text('reason_boolean')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_answers');
    }
};
