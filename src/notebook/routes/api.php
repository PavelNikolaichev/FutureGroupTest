<?php

use App\Http\Controllers\NotebookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('/notebook', [NotebookController::class, 'index']);
    Route::post('/notebook', [NotebookController::class, 'store']);

    Route::get('/notebook/{notebook}', [NotebookController::class, 'show']);
    Route::post('/notebook/{notebook}', [NotebookController::class, 'update']);
    Route::delete('/notebook/{notebook}', [NotebookController::class, 'destroy']);
});
