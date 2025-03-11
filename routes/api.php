<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\FlashcardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('account', 'account')->middleware('auth:sanctum');
    Route::get('logout', 'logout')->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('decks', DeckController::class);

    Route::get('/decks/{deckId}/flashcards', [FlashcardController::class, 'index']);
    Route::post('/decks/{deckId}/flashcards', [FlashcardController::class, 'store']);
    Route::get('/decks/{deckId}/flashcards/{flashcardId}', [FlashcardController::class, 'show']);
    Route::patch('/decks/{deckId}/flashcards/{flashcardId}', [FlashcardController::class, 'update']);
    Route::delete('/decks/{deckId}/flashcards/{flashcardId}', [FlashcardController::class, 'destroy']);
});