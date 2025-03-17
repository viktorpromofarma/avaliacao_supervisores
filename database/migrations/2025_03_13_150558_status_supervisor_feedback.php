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
        Schema::create('status_supervisor_feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('month');
            $table->integer('year');
            $table->foreign('user_id')->references('id')->on('usuarios_avaliacao_supervisao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_supervisor_feedback');
    }
};
