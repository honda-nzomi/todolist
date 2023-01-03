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
                              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Todoを入力してください" name="task_name">
                          </div>
                          
                          <div class="form-group">
                            <label for="date" class="col-form-label">期限日を入力</label>
                            <input type="datetime-local" class="form-control" id="date" placeholder="期限日時を入力してください" name="date">
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
                  　　　　<div class="list-group list-group-horizontal rounded-0 bg-transparent align-items-center">
                            <div class="list-group-item">
                              要素１
                            </div>
                            <!--デットラインを表示-->
                            <!--マイグレーションフォルダの中のテーブルの中のカラムと同じ名前-->
                            @php $dt = new Datetime($item->deadline); @endphp
                            <div class="list-group-item" style="font-size: 20px; color: white">{{ $dt->format('m月d日 H時i分') }}</div>
                      
                            <div class="list-group-item">
                            
                                
                              <form action="/tasks/{{ $item->id }}" method="post" role="menuitem" tabindex="-1">
                                @csrf
                                @method('PUT')
                                @if ($item->status)  
                                  <button type="submit" class="btn btn-outline-primary btn-block" disabled>完了</button>
                                @else
                                <!--updateメソッド-->
                                  <input type="hidden" name="status" value="{{$item->status}}">
                                  <button type="submit" class="btn btn-Primary btn-block">完了</button>
                              @endif  
                              </form>
                            </div>
                            <div class="list-group-item">
                              
                              <form action="/tasks/{{ $item->id }}/edit/" method="get" role="menuitem" tabindex="-1">
                                <input type="hidden" name="status" value="{{$item->status}}">
                                  <button type="submit" class="btn btn-success btn-block">編集</button>
                                
                              </form>
                            </div>
                            <div class="list-group-item text-align-center">
                            
                              <form onsubmit="return deleteTask();" action="/tasks/{{ $item->id }}" method="post" role="menuitem" tabindex="-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-block">削除</button>
                              </form>
                             
                            </div>
                          </div>
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

