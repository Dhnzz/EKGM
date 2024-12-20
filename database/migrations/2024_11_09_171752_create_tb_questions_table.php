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
        Schema::create('tb_questions', function (Blueprint $table) {
            $table->id();
            $table->text('instrument');
            $table->text('question_sub');
            $table->text('question_text')->nullable();
            $table->json('question_json')->nullable();
            $table->enum('question_type', ['text','integer','boolean','date', 'json']);
            $table->enum('category', ['engaging','focusing','evoking','planning']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_questions');
    }
};
