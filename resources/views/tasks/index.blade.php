@extends('layouts.todolist')

@section('content')
  
<div class="container">
          <div class="py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
                <div class="card-body py-4 px-4 px-md-5">
      
                  <p class="h1 text-center pb-3 text-dark">
                    今日は何をする？
                  </p>

                  <div class="pb-2">
                      <form action="/tasks" method="post" class="align-items-center mb-4">
                          @csrf
                          <div class="form-outline flex-fill">
                              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="洗濯ものをする・・・" name="task_name">
                          </div>
                          @error('task_name')
                            <p class="form-text text-danger">{{ $message }}</p>
                          @enderror
                          <div class="row">
                            <div class="text-center my-3">
                              <button type="submit" class="btn btn-dark px-5">追加</button>
                            </div>
                          </div>
                      </form> 
                  </div>
                  
                  <hr class="my-0">
  
                  @if ($tasks->isNotEmpty())
                      @foreach ($tasks as $item)
                  　　　　<ul class="list-group list-group-horizontal rounded-0 bg-transparent">
                            <li class="list-group-item px-0 py-1 d-flex align-items-center flex-grow-1 border-0 rounded">
                              <p class="lead fw-normal mb-0 px-2">{{ $item->name }}</p>
                            </li>
                            <li class="ps-3 py-1 rounded-0 border-0 bg-transparent">
                              <div class="d-flex flex-row justify-content-end mb-1">
                                  <form action="/tasks/{{ $item->id }}" method="post" role="menuitem" tabindex="-1">
                                  @csrf
                                  @method('PUT')
                                  <input type="hidden" name="status" value="{{$item->status}}">
                                  <button type="submit" class="btn btn-success btn-block mx-1">完了</button>
                                  </form>
                                  <a href="/tasks/{{ $item->id }}/edit/" class="btn btn-primary btn-block mx-1">
                                  編集
                                  </a>
                                  <form onsubmit="return deleteTask();" action="/tasks/{{ $item->id }}" method="post" role="menuitem" tabindex="-1">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger btn-block mx-1">削除</button>
                                  </form>
                              </div>
                            </li>
                          </ul>
                      @endforeach
                  @endif
                </div>
              </div>
            </div>
          </div>
    </div>
    <script>
    function deleteTask() {
        if (confirm('本当に削除しますか？')) {
            return true;
        } else {
            return false;
        }
    }
    </script>


@endsection



<!--<!DOCTYPE>-->

<!--<html lang="ja">-->
    
<!--<head>-->
<!--  <meta chardet="UTF-8">-->
<!--  <meta name="viewport" content="widsh=device-width,initial-scale=1.0">-->
<!--  <meta http-equiv="X-UACompatible" content="ie=edge">-->
<!--  <title>Todo</title>-->
  <!--TailWindCssの導入のため-->
<!--  <script src="https://cdn.tailwindcss.com"></script>-->
<!--</head>-->

<!--<body class="flex flex-col min-h-[100vh]">-->
<!--  <header class="bg-slate-800">-->
<!--    <div class="max-w7xl mx-aoto px-4 sm:px-6">-->
<!--      <div class="py-6">-->
<!--        <P class="text-white text-xl">Todoアプリ</P>-->
<!--      </div>-->
<!--    </div>-->
<!--  </header>-->

<!--  <main class="grow">-->
<!--    <div class="max-w-7xl mx-auto px-4 sm:px-6">-->
<!--      <p class ="text-2xl font-bold text-center">今日は何をする？</p>-->
      <!--追加するボタンを押したら、DBに保存したいの、で-->
      <!--TaskController.php の store メソッドを使う。-->
      <!--なので formのアクション属性は「/tasks」で、methodはPOSTにする-->
      <!--？？？？タスクを入力するテキスト入力欄？？？（name属性の値はtask_name）と、ボタンをformタグで囲む-->
<!--      <form action="/tasks" method="post" class="mt=10">-->
        <!--Laravelでフォームをつくる場合は、セキュリティ対策のCSRF対策として、必ず「csrf」というディレクティブが必要-->
<!--        @csrf-->
        
<!--        <div class="flex flex-col items-center">-->
<!--          <label class="w-full max-w-3xl mx-auto">-->
<!--            <input-->
<!--              class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"-->
<!--              placeholder="洗濯物をする..."　type="text" name="task_name" />-->
              <!--errorディレクティブを使用-->
              <!--アットマークerrorカッコの中は'キー名'-->
<!--              @error('task_name')-->
<!--                <div class="mt-3">-->
<!--                  <p class="text-red-500">-->
                    <!--指定のキーに対するエラーが発生しているかチェックし、もし発生していたら、-->
                    <!--それに対応するエラー文を$messageで出力-->
<!--                    {{ $message }}-->
                    <!--これで、先ほどコントローラーで設定した-->
                    <!--task_nameキーに設定したバリデーションのうちのどちらかに引っかかれば、-->
                    <!--それに該当するメッセージが表示される-->
<!--                  </p>-->
<!--                </div>-->
<!--              @enderror  -->
<!--          </label>-->
          <!--ボタン-->
<!--          <button type="submit" class="mt-8 p-4 bg-slate-800 text-white w-full max-wxs hover:bg-slate-900 transition-colors">-->
<!--            追加する-->
<!--          </button>-->
<!--        </div>-->
        
<!--      </form>-->
      
<!--      @if ($tasks->isNotEmpty())-->
<!--        <div class="max-w-7xl mx-auto mt-20">-->
<!--          <div class="inline-block min-w-full py-2 align-middle">-->
<!--            <div class="overflow-hidden shadow ring-1 ring-block ring-opacity-5 md:rounded-lg">-->
<!--              <table class="min-w-full divide-y divide-gray-300">-->
<!--                <thead class="bg-gray-50">-->
<!--                  <tr>-->
<!--                    <th scope="col"-->
<!--                      class="py-3.5 pl-4 pr-3 text-left text-sm font-seibold text-gray-900"> -->
<!--                      タスク-->
<!--                    </th>-->
<!--                    <th scope="col" class="relative py-3.5 pl-3 pr-4  sm:pr-6">-->
<!--                      <span class="sr-only">Action</span>-->
<!--                    </th>-->
<!--                  </tr>-->
<!--                </thead>-->
<!--                <tbody class="divide-y divide-gray-200 bg-white">-->
                  <!--compactdeで渡されたデータ$tasksが使えるようになる-->
<!--                  @foreach($tasks as $item)-->
                  
<!--                    <tr>-->
<!--                      <td class="px-3 py-4 text-sm text-gray-500">-->
<!--                        <div>-->
<!--                          {{ $item->name }}-->
<!--                        </div>-->
<!--                      </td>-->
<!--                      <td class="p-0 text right text-sm font-medium">-->
<!--                        <div class="flex justify-end">-->
<!--                          <div>-->
<!--                            <form action="/tasks/{{ $item->id }}"-->
<!--                              method="post"-->
<!--                              class="inline-block text-gray-500 font-medium"-->
<!--                              role="menuitem" tabindex="-1">-->
<!--                              @csrf-->
<!--                              @method('PUT')-->
<!--                              <input type="hidden" name="status" value="{{$item->status}}">-->
                              <!--<button type="submit" 
<!--                                  class="bg-emerald-700 py-4 w-20 text-white md:hover:bg-emerld-800 transition-colors">-->-->

                                <!--ボタンを黒に変更した-->
<!--                              <button type="submit" -->
<!--                                class="mt-8 p-4 bg-slate-800 text-white w-full max-wxs hover:bg-slate-900 transition-colors">完了</button>-->
<!--                            </form>-->
<!--                          </div>-->
<!--                          <div>-->
<!--                            <a href="/tasks/{{ $item->id }}/edit/"-->
<!--                              class="inline-block text-center py-4 w-20 underline underline-offset-2 text-sky-600 md:hover:bg-sky-100 transition-colors">編集</a>-->
<!--                          </div>-->
<!--                          <div>-->
<!--                            <form onsubmit="return deleteTask();"-->
<!--                              action="/tasks/{{ $item->id }}" method="post"-->
<!--                              class="inline-block text-gray-500 font-medium"-->
<!--                              role="menuitem" tabindex="-1">-->
<!--                              @csrf-->
<!--                              @method('DELETE')-->
<!--                              <button type="submit"-->
<!--                                class="py-4 w-20 md:hover:bg-slate-200 transition-colors">-->
<!--                                削除-->
<!--                              </button>  -->
<!--                            </form>-->
<!--                          </div>-->
<!--                        </div>-->
<!--                      </td>-->
<!--                    </tr>-->
<!--                  @endforeach -->
<!--                </tbody>-->
<!--              </table>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      @endif-->
      
<!--    </div>-->
<!--  </div>-->
<!--</main>-->
<!--<footer class="bg-slate-800">-->
<!--  <div class ="max-w-7xl mx-auto px-4 sm:px-6">-->
<!--    <div class="py-4 text-center">-->
<!--      <p class="text-white text-sm">Todoアプリ</p>-->
<!--    </div>-->
<!--  </div>-->
<!--  </footer>-->
  
<!--  <script>-->
<!--    function deleteTask() {-->
<!--        if (confirm('本当に削除しますか？')) {-->
<!--            return true;-->
<!--        } else {-->
<!--            return false;-->
<!--        }-->
<!--    }-->
<!--  </script>-->

<!--</body>-->

<!--</html>-->