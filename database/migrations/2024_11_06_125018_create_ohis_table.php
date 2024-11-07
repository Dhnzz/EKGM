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
        Schema::create('ohis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('responden_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->integer('di_1');
            $table->integer('di_2');
            $table->integer('di_3');
            $table->integer('di_4');
            $table->integer('di_5');
            $table->integer('di_6');
            $table->integer('ci_1');
            $table->integer('ci_2');
            $table->integer('ci_3');
            $table->integer('ci_4');
            $table->integer('ci_5');
            $table->integer('ci_6');
            $table->float('total_di');
            $table->float('total_ci');
            $table->float('ohi');
            $table->string('kesimpulan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ohis');
    }
};
