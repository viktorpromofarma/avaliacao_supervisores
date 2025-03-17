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
        Schema::create('save_supervisor_feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('answer_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('commentAdd')->nullable()->max(255);
            $table->string('positivePoints')->nullable()->max(255);
            $table->string('pointsToImprove')->nullable()->max(255);
            $table->string('recomendation')->nullable()->max(255);
            $table->string('conclusion')->nullable()->max(255);
            $table->integer('month');
            $table->integer('year');
            $table->foreign('answer_id')->references('id')->on('save_user_answers');
            $table->foreign('category_id')->references('id')->on('category_questions_supervisors_assessment');
            $table->foreign('user_id')->references('id')->on('usuarios_avaliacao_supervisao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('save_supervisor_feedback');
    }
};
