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
        Schema::create('questions_supervisors_assessment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('type_id');
            $table->integer('category_id');
            $table->foreign('type_id')->references('id')->on('type_questions_supervisors_assessment');
            $table->foreign('category_id')->references('id')->on('category_questions_supervisors_assessment');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
