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
        Schema::create('services', function (Blueprint $table) {
            $table->integer(column: 'id')->autoIncrement()->nullable(value: false);
            $table->string('name')->nullable(value: false);
            $table->string('description')->unique()->nullable(value: false);
            $table->string('duration_minutes')->nullable(value: false);
            $table->string('price')->nullable(value: false);
            $table->integer('id_salon')->nullable(value: false);
            $table->boolean('active')->nullable(value: false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
