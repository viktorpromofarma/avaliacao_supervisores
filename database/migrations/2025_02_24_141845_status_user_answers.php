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
        Schema::create('status_user_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('supervisor');
            $table->integer('month');
            $table->integer('year');
            $table->integer('store');
            $table->foreign('user_id')->references('id')->on('usuarios_avaliacao_supervisao');
            $table->foreign('supervisor')->references('id')->on('usuarios_avaliacao_supervisao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_user_answers');
    }
};
