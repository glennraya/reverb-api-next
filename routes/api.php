<?php

use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/get-unread-messages', [ChatMessageController::class, 'getUnreadMessages']);

    Route::post('/get-team-members', [TeamController::class, 'index']);

    Route::post('/send-message', [ChatMessageController::class, 'store']);
});
