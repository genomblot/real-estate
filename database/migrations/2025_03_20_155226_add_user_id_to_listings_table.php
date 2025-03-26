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
        Schema::table('listings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(); // Добавляем столбец user_id как внешний ключ
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Устанавливаем внешний ключ на таблицу users
            $table->index('user_id'); // Добавляем индекс для улучшения производительности
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Удаляем внешний ключ
            $table->dropIndex(['user_id']);   // Удаляем индекс
            $table->dropColumn('user_id');    // Удаляем столбец
        });
    }
};
