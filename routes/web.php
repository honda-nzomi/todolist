<?php
// 私はこのクラスを使います
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\HomeController;

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

// Route::get('/test', function () {
//     return view('test');
// });

Route::get('/', function () {
    return view('welcome');
});

// /にアクセスした際に、Homeコントローラーのindexメソッドを実行

Route::get('/', [HomeController::class, 'index']);

// 認証機能に関するルーティング
Auth::routes();
/// 割り振りをするため
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
     // アドレス,コントローラーの名前::class , メソッド名
Route::get('/list', [TodoListController::class, 'index']);
/// getで、'/tasks' を呼ばれたら、
/// TaskControllerさん、あとお願いね～
/// TaskController の'index' の処理をする
// Route::get('/tasks', [TaskController::class, 'index']);
//一覧表示
// Route::get('/tasks',[TaskController::class,'index']);
/// cred の R 以外は全部必要
//タスク追加
// Route::get('/create',[TaskController::class,'add']);
// Route::post('taks/create',[TaskController::class,'create']);
//タスク更新
// Route::get('/edit',[TaskController::class,'edit']);
// 画面から飛んできたデータを処理する
// Route::post('/edit',[TaskController::class,'update']);
//タスク削除
// Route::post('/delete',[TaskController::class,'delete']);
/// エラーが出たので追加した 
// Route::post('/tasks', [TaskController::class, 'store']);
Route::resource('tasks', TaskController::class)->middleware('auth');

 
