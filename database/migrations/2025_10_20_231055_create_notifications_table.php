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
        Schema::create('notifications', function (Blueprint $table) {
            $table->integer(column: 'id')->autoIncrement()->nullable(value: false);
            $table->integer('id_user')->nullable(value: false);
            $table->string('type')->nullable(value: false);
            $table->string('title')->nullable(value: false);
            $table->string('message')->nullable(value: false);
            $table->string('notes')->nullable(value: false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
