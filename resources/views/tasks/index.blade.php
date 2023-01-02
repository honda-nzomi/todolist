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
                  　　　　<ul class="list-group list-group-horizontal rounded-0 bg-transparent">
                            <li class="list-group-item px-0 py-1 d-flex align-items-center flex-grow-1 border-0 rounded">
                              @if ($item->status === 1)
                                <del><p class="lead fw-normal mb-0 px-2">{{ $item->name }}</p></del>
                              @else
                                <p class="lead fw-normal mb-0 px-2">{{ $item->name }}</p>
                              @endif  
                            </li>
                            <!--デットラインを表示-->
                            <!--マイグレーションフォルダの中のテーブルの中のカラムと同じ名前-->
                            @php $dt = new Datetime($item->deadline); @endphp
                            <div class="card bg-info mb-0 px-2 align-middle text-center" style="font-size: 20px; color: white">{{ $dt->format('m月d日 H時i分') }}</div>
                      
                            <li class="ps-3 py-1 rounded-0 border-0 bg-transparent">
                              <div class="d-flex flex-row justify-content-end mb-1">
                               
                                <form action="/tasks/{{ $item->id }}" method="post" role="menuitem" tabindex="-1">
                                  @csrf
                                  @method('PUT')
                                  @if ($item->status)  
                                    <button type="submit" class="btn btn-outline-primary btn-block mx-1" disabled>完了</button>
                                  @else
                                  <!--updateメソッド-->
                                    <input type="hidden" name="status" value="{{$item->status}}">
                                    <button type="submit" class="btn btn-Primary btn-block mx-1">完了</button>
                                @endif  
                                </form>
                                <form action="/tasks/{{ $item->id }}/edit/" method="get" role="menuitem" tabindex="-1">
                                  <input type="hidden" name="status" value="{{$item->status}}">
                                    <button type="submit" class="btn btn-success btn-block mx-1">編集</button>
                                  
                                  </form>
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

