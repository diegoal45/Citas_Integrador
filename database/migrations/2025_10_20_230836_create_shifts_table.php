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
        Schema::create('shifts', function (Blueprint $table) {
            $table->integer(column: 'id')->autoIncrement()->nullable(value: false);
            $table->integer('id_professional')->nullable(value: false);
            $table->string('day_week')->unique()->nullable(value: false);
            $table->string('start_time')->nullable(value: false);
            $table->string('end_time')->nullable(value: false);
            $table->string('effective_start_date')->nullable(value: false);
            $table->string('effective_end_date')->nullable(value: true);
            $table->boolean('active')->nullable(value: false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
