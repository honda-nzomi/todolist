@extends('layouts.todolist')

@section('content')

<div class="container">
          
            <!--row-->
            <div class="row d-flex justify-content-center align-items-center">
              <!--<div class="card" id="list1" style="border-radius: .75rem; background-color: #EFF1F2;">-->
                <div class="card-body py-4 px-4 px-md-5">


                  <div class="pb-2">

                      <div class="row ">
                        
                          <form action="/tasks" method="post" class="align-items-center mb-4">
                            @csrf
                            <div class="form-group row">
                              
                            <div class="col-md-7">
                              <!--<div class="col-9 form-outline flex-fill">-->
                                  <label for="date" class="col-form-label">Todoを入力</label>
                                  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Todoを入力してください" name="task_name">
                              </div>
                              <div class="col-md-2">
                              <!--<div class="col-3 form-group">-->
                                <label for="date" class="col-form-label">期限日を入力</label>
                                <input type="datetime-local" class="form-control" id="date"  name="date">
                              </div>
                        
                              @error('task_name')
                              <p class="form-text text-danger">{{ $message }}</p>
                              @enderror
                            
                              <div class="col-md-3 text-center">
                               
                                <button type="submit" class="btn btn-dark px-5">Todo追加</button>
                              </div>
                            </div>
                          </form>
                            </div>
                        </div>
                   <!--</div>-->
                      
                  </div>
                  
                  <hr class="my-0">
                  <!--<p class="lead fw-normal mb-0 py-2"></p>-->
                  <p class="mb-0 py-2"></p>

                  <p class="h1 text-left pb-3 text-dark">
                  {{Auth::user()->name}}さんのTodo
                    
                  </p>

                  @if ($tasks->isNotEmpty())
                      @foreach ($tasks as $item)
                      <div class="row py-2">
                        
                  　　　{{--　<ul class="list-group list-group-horizontal rounded-0 bg-transparent">--}}
                            
                          <div class="col-sm-10 card mb-0 px-2 align-middle text-center border-0" style="font-size: 14px;">
                            <table>
                              
                              <tr>
                                <td colspan="4" class="card">
                                 {{--<li class="list-group-item px-0 py-1 d-flex align-items-center flex-grow-1 border-0 rounded">--}}
                                  @if ($item->status === 1)
                                    <del><p class="lead fw-normal mb-0 px-2">{{ $item->name }}</p></del>
                                  @else
                                    <p class="lead fw-normal mb-0 px-2">{{ $item->name }}</p>
                                  @endif
                                </td>
                              </tr>
                              
                              <tr>
                                <td width="76%">
                               
                                  <!--デットラインを表示-->
                                  <!--マイグレーションフォルダの中のテーブルの中のカラムと同じ名前-->
                                  @php $dt = new Datetime($item->deadline); @endphp
                                  {!! $dt->format('m月d日') !!}<br>
                                  {!! $dt->format('H時i分') !!}
                                </td>
                                <td width="8%">
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
                                </td>
                                <td width="8%">
                                  <form action="/tasks/{{ $item->id }}/edit/" method="get" role="menuitem" tabindex="-1">
                                    <input type="hidden" name="status" value="{{$item->status}}">
                                      <button type="submit" class="btn btn-success btn-block mx-1">編集</button>
  
                                  </form>
                                </td>
                                <td width="8%">
                                  <form onsubmit="return deleteTask();" action="/tasks/{{ $item->id }}" method="post" role="menuitem" tabindex="-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-block mx-1">削除</button>
                                  </form>
                                </td>
                              </tr>
                            </table>
                          </div> 
                        </div>
                      <!--<hr class="my-0">-->
                      @endforeach
                  @endif
                
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