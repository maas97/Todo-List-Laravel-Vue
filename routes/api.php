<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tasks' , [TaskController::class , 'index'])->name(name:'tasks.index');
Route::prefix('task')->group( function(){
        Route::post('store', [TaskController::class, 'store'])->name(name:'tasks.store');
        Route::put('/{id}', [TaskController::class, 'update'])->name(name:'tasks.update');
        Route::delete('/{id}', [TaskController::class, 'destroy'])->name(name:'tasks.destroy');
});

Route::post('markAsComplete/{id}', [TaskController::class, 'markAsComplete']);
Route::post('markAsIncomplete/{id}', [TaskController::class, 'markAsIncomplete']);