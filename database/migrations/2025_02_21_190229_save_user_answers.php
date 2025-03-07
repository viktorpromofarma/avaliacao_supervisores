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
        Schema::create('save_user_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('question_id');
            $table->integer('answer_id')->nullable();
            $table->string('answer_text')->nullable();
            $table->foreign('question_id')->references('id')->on('questions_supervisors_assessment')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('usuarios_avaliacao_supervisao');
            $table->unique(['user_id', 'question_id', 'created_at']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('save_user_answers')) {
            Schema::dropIfExists('save_user_answers');
        }
    }
};
