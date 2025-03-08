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
        Schema::create('decks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('type')->nullable();
            $table->string('imageBg')->nullable();
            $table->boolean('isFavorite')->default(false);
            $table->uuid('userId')->nullable();
            $table->boolean('isSuperUser')->default(false);
            $table->timestamps();

            $table->foreign('userId')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('decks', function (Blueprint $table) {
            $table->dropForeign(['userId']); // Xóa khóa ngoại
        });
        Schema::dropIfExists('decks');
    }
};
