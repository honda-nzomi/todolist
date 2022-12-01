<?php
// 私はこのクラスを使います
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TaskController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// 割り振りをするため
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
     // アドレス,コントローラーの名前::class , メソッド名
Route::get('/list', [TodoListController::class, 'index']);
// getで、'/tasks' を呼ばれたら、
// TaskControllerさん、あとお願いね～
// TaskController の'index' の処理をする
Route::get('/tasks', [TaskController::class, 'index']);

Route::post('/tasks', [TaskController::class, 'store']);