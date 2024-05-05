<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/todos', [TodoController::class, 'index']);
Route::get('/todos/{id}', [TodoController::class, 'get']);
Route::post('/todos', [TodoController::class, 'store']);
Route::delete('/todos/{id}', [TodoController::class, 'delete']);
Route::delete('/todos', [TodoController::class, 'deleteAllCompleted']);

Route::get('/', function () {
    return view('welcome');
});
