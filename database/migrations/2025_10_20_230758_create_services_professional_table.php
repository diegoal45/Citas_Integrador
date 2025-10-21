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
        Schema::create('services_professional', function (Blueprint $table) {
            $table->integer(column: 'id')->autoIncrement()->nullable(value: false);
            $table->integer('id_service')->nullable(value: false);
            $table->integer('id_professional')->unique()->nullable(value: false);
            $table->string('custom price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_professional');
    }
};
