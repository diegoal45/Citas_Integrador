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
        Schema::create('reviews', function (Blueprint $table) {
            $table->integer(column: 'id')->autoIncrement()->nullable(value: false);
            $table->integer('id_cita')->nullable(value: false);
            $table->integer('id_cliente')->nullable(value: false);
            $table->integer('id_professional')->nullable(value: false);
            $table->integer('id_service')->nullable(value: false);
            $table->string('qualification')->nullable(value: false);
            $table->string('comment')->unique()->nullable(value: false);
            $table->string('professional_response')->nullable(value: false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
