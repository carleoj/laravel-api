<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(['auth:sanctum']);

Route::get('/hello', function (Request $request) {
    return response()->json([
        "Hello" => "World"
    ]);
});

Route::prefix('v1')->group(function() {
    Route::apiResource('posts', PostController::class);
});




