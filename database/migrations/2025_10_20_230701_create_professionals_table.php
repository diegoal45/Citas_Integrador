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
        Schema::create('professionals', function (Blueprint $table) {
            $table->integer(column: 'id')->autoIncrement()->nullable(value: false);
            $table->integer('id_user')->nullable(value: false);
            $table->integer('id_salon')->unique()->nullable(value: false);
            $table->string('specialty')->nullable(value: false);
            $table->string('description')->nullable(value: false);
            $table->string('avatar')->nullable(value: true);
            $table->boolean('active')->nullable(value: false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionals');
    }
};
