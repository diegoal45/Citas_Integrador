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
        Schema::create('dates', function (Blueprint $table) {
            $table->integer(column: 'id')->autoIncrement()->nullable(value: false);
            $table->integer('id_user')->nullable(value: false);
            $table->integer('id_professional')->nullable(value: false);
            $table->integer('id_service')->nullable(value: false);
            $table->string('confirmation_code')->nullable(value: false);
            $table->string('date')->nullable(value: false);
            $table->string('start_time')->nullable(value: false);
            $table->string('end_time')->nullable(value: false);
            $table->boolean('active')->nullable(value: false);
            $table->string('final_price')->nullable(value: false);
            $table->string('notes')->nullable(value: false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dates');
    }
};
