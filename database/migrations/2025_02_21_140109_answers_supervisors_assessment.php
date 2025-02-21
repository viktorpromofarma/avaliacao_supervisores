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
        Schema::create('answers_supervisors_assessment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->float('note');
            $table->integer('question_id');
            $table->foreign('question_id')->references('id')->on('questions_supervisors_assessment')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        if (Schema::hasTable('answers_supervisors_assessment')) {
            Schema::dropIfExists('answers_supervisors_assessment');
        }
    }
};
