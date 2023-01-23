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
use Auth;
use Carbon\Carbon;

// モデルクラスの、「Tasks」から、データを取得する処理？？？
class TaskController extends Controller
{
  public function index()
  {
    /// レコードとは、カラムが列なら、レコードは行むたいな...
    // モデル名::all() で、モデルのレコードを全部取得できる
    // $tasks = Task::all();
    ///  未完了のものだけ表示する
    // $tasks = Task::where('status', false)->get();
    // 期限日時の昇順で取得する
    // $tasks = Auth::user()->tasks()->orderBy('deadline', 'asc')->get();
    $tasks = Auth::user()->tasks->sortBy([
      ['status', 'asc'],
      ['deadline', 'asc']]);
    $carbon = Carbon::today();
    $tomorrow = Carbon::tomorrow();
    // $trip_contents = TripContents::orderBy('recruitment_end_date', 'asc')->get();
    // $data = $users->orderBy('deadline', 'asc')->get();
    
    /// 複数のレコードを取得するとき // $変数 = モデルクラス::where(カラム名, 値)->get(); 
    /// 最初のレコードだけ取得するとき // $変数 = モデルクラス::where(カラム名, 値)->first();

    
    
    // viewメソッドの第一引数には、「どのビューファイルか」を指定
    // return view('tasks.index');
    return view('tasks.index', compact('tasks','carbon','tomorrow'));
    // compact関数を使うと簡単に書くことができる
    /// compact関数とは、変数名とその値から配列を作成する
  }
  // タスク入力画面で、「追加する」を押したらこのstoreメソッドにその値が渡ってくる
  // 依存性注入
  /// 私はこのRequest(５行目に記載)クラスを使います
  
  public function create()
  {
    // 使わない
  }
  // storeメソッドで、登録処理
  // Requestというクラスのインスタンスである$requestという変数を引数でもらう。
  // ブラウザーの情報
  public function store(Request $request)
  {
    // request->input('フォームのキーの名前')
    // と書くことで、フォームから送信されたデータのうち、特定のキーの値を取り出す
    // $task_name = $request->input('task_name');
    // dd($task_name);
    
    $rules = [
      // $task_name = $request->input('task_name');
      // dd($task_name);
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
    // useを記載する
    $task->user_id = Auth::id();
    
    // tasksテーブルのカラムにデットラインを設定する処理
    // $dateTime = '2018/04/05';
    $task->deadline = $request->input('date');
    // dd($task->deadline);
    
    // $date->setDate(2014,8,1)->setTime(1,10,13);
    // echo $date->format('Y-m-d H:i:s'); // 2014-08-01 01:10:13
     
    // $format = 'Y年m月d日 H時i分s秒';
    // $date = DateTime::createFromFormat($format, '2014年02月05日 23時11分24秒');
    // echo $date->format('Y-m-d H:i:s');
    
    //データベースに保存 /// saveメソッドを実行
    $task->save();
    
    // リダイレクト-> /tasksが再び表示されるように、redirectメソッドを使う 
    /// リダイレクトとは、新しいURLに変更した際、自動的に転送をする仕組み
    return redirect('/tasks');
    
  } 
  
  public function show()
  {
    //
  }
  // モデル名::find(整数); で $idに一致するレコードを取得する
  // editメソッドで編集画面のビューを返す
  public function edit($id)
  {
    $task = Task::find($id);
    return view('tasks.edit', compact('task'));
  }
  
  public function update(Request $request,$id)
  {
    
    //「編集する」ボタンをおしたとき
    /// 編集できるね Ok~s
    if ($request->status === null) {
    
      $rules = [
        'task_name' => 'required|max:100',
      ];
      
      $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。'];
    
      Validator::make($request->all(), $rules, $messages)->validate();
      
      //該当のタスクを検索
      $task = Task::find($id);
      
      //モデル->カラム名 = 値 で、データを割り当てる
      $task->name = $request->input('task_name');
      
      $task->deadline = $request->input('date');
      
      //データベースに保存
      $task->save();
    } else {
      //「完了」ボタンを押したとき
      /// あれっ？完了できないやん？
      //該当のタスクを検索
      $task = Task::find($id);
      
      //モデル->カラム名 = 値 で、データを割り当てる
      $task->status = true; //true:完了、false:未完了
      //データベースに保存
      $task->save();
    }
      
    //リダイレクト
    return redirect('/tasks');
  }
  
  public function destroy($id)
  {
    // レコードを、findで探し、deleteメソッドを呼び出すだけで削除ができる
    Task::find($id)->delete();
    // 削除したあとは元の画面に
    // 戻ってきてほしいのでリダイレクトする
    return redirect('/tasks');
  }
  
}