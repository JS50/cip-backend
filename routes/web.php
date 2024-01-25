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

Route::get('/todos',[TodoController::class, 'index']); //get all todos
Route::post('/todos',[TodoController::class, 'store']); //create new todo
Route::delete('/todos',[TodoController::class, 'destroyAll']); //delete all todos

Route::patch('/todos/{todo}', [TodoController::class, 'update']); //toggle done of todo
Route::delete('/todos/{todo}', [TodoController::class, 'destroy']); //delete a todo
