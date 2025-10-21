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
        Schema::create('salons', function (Blueprint $table) {
            $table->integer(column: 'id')->autoIncrement()->nullable(value: false);
            $table->string(column:'name')->unique()->nullable(value: false);
            $table->string('address')->nullable(value: false);
            $table->string('phone')->nullable(value: false);
            $table->string('email')->unique()->nullable(value: false);
            $table->string('logo')->unique()->nullable(value: false);
            $table->string('description')->unique()->nullable(value: false);
            $table->boolean('active')->nullable(value: false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salons');
    }
};
