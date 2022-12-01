<?php
/// 私はここにいるクラスです
namespace App\Http\Controllers;
/// 私はこのクラスを使います
use Illuminate\Http\Request;
// 15行目のモデルクラス「TodoList」を使うために、
// スクリプトの先頭でuse文によりTodoListを読み込む
use App\Models\TodoList;

class TodoListController extends Controller
{
  // モデルクラスの、「Todolist」から、データを取得する処理？？？？？？
  public function index(Request $request)
  {
    // データベースからテーブル「todo_lists」にある全レコードを取得
    $todo_lists = TodoList::all();
    // dd($todo_lists);
    // 取得した値をビューに渡す処理
    // テンプレートに変数「todo_lists」を渡す
    // viewメソッドの第一引数には、「どのビューファイルか」を指定
    // 変数名と値がペアになった連想配列を第2引数に設定
    return view('todo_list.index', ['todo_lists' => $todo_lists]);
  }
}
