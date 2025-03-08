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
        Schema::create('flashcards', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('text');
            $table->string('imgUrl')->nullable();
            $table->text('description')->nullable();
            $table->string('language');
            $table->boolean('isMarked')->default(false);
            $table->uuid('deckId');
            $table->timestamps();

            $table->foreign('deckId')
                ->references('id')
                ->on('decks')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flashcards', function (Blueprint $table) {
            $table->dropForeign(['deckId']); // Xóa khóa ngoại
        });
        Schema::dropIfExists('flashcards');
    }
};
