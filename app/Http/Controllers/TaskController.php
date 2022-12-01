<?php
/// 私はここにいるクラスです
namespace App\Http\Controllers;
/// 私はこのクラスを使います
use Illuminate\Http\Request;
// 15行目のモデルクラス「Tasks」を使うために、
// スクリプトの先頭でuse文によりtasksを読み込む
use App\Models\Task;
// Validatorクラスを使うため
use Illuminate\Support\Facades\Validator;

// モデルクラスの、「Tasks」から、データを取得する処理？？？
class TaskController extends Controller
{
  public function index()
  {
    // viewメソッドの第一引数には、「どのビューファイルか」を指定
    return view('tasks.index');
  }
  // タスク入力画面で、「追加する」を押したらこのstoreメソッドにその値が渡ってくる
  // 依存性注入
  /// 私はこのRequest(５行目に記載)クラスを使います
  public function store(Request $request)
  {
    // request->input('フォームのキーの名前')
    // と書くことで、フォームから送信されたデータのうち、特定のキーの値を取り出す
    // $task_name = $request->input('task_name');
    // dd($task_name);
    
    $rules = [
      /// task_nameに、100文字以下(max:100)をバリデーションルールとして設定
      'task_name' => 'required|max:100'
    ];
    
    /// task_nameに、必須(required)
    $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。'];
    
    // Validator::make($request->all(),バリデーションルール,エラーメッセージ);
    // 第1引数には、$request->all() を指定
    // 第3引数では、配列を指定し、バリデーションのエラーメッセージをカスタマイズできる
    // [バリデーションルールの名前=>エラーメッセージ]
    Validator::make($request->all(), $rules, $messages)->validate();  
    /// validateメソッドを呼び出すことで、エラーがあったときは元の画面に戻るようにする
    /// バリデーションに引っかかったときはそれ以降のデータベースへの保存処理は実行されない
    
    /// storeメソッド内で受け取った値はデータベースに保存される
  
    // モデルをインスタンス化
    $task = new Task;
    
    //モデル->カラム名 = 値 で、データを割り当てる
    /// カラムとは､Excelでいう「列」のこと...データベースに入っているデータの「項目」のこと
    $task->name = $request->input('task_name');
    
    //データベースに保存 /// saveメソッドを実行
    $task->save();
    
    // リダイレクト-> /tasksが再び表示されるように、redirectメソッドを使う 
    /// リダイレクトとは、新しいURLに変更した際、自動的に転送をする仕組み
    return redirect('/tasks');
    
  }  
}