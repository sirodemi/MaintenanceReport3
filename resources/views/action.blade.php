@extends('layouts.base')
@section('title','処置管理画面')
@section('header')
    @parent
@endsection

@section('top')
<div>[処置]　登録・変更・削除</div>
@endsection

@section('content')

<!-- 処置登録フォーム -->
<div class="col-md-11 mb-1 ">
    <form action="{{ route('action')}}" method="POST" class="formhorizontal">
        {{csrf_field()}}
        <label for="action" class="ml-2">処置追加</label>
        <div class="input-group mb-4 ml-4">
            <input type="text" class="form-control" name="action"　id="action" placeholder="処置を追加">
            <div class="input-group-prepend">
                <button type="submit" class="btn btn-secondary">登録</button>
            </div>
        </div>
    </form>
</div>


<!-- 既に登録されてる処置のリスト -->
@if(count($items_action) > 0)
<div class="card-body">
    {{-- <div class="card-title">処置リスト</div> --}}
    <div class="card-body">
        <table class="table table-striped task-table table-sm">
            <!-- テーブルヘッダ -->
            <thead>
                <th>ACT</th>
                <th>処置</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </thead>
            <!-- テーブル本体 -->
            <tbody>
                @foreach ($items_action as $action)
                    <tr>
                        <!-- id -->
                        <td class="table-text">
                            <div>{{$action->id}}</div>
                        </td>


                        <!-- 処置 -->
                        <td class="table-text">
                            <div>{{$action->action}}</div>
                        </td>



                        <!-- 更新ボタン -->
                        <td>
                            <form action="{{ url('action_edit/'.$action->id)}}" method="POST">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-secondary py-0">  変更  </button>
                            </form>
                        </td>

                        <!-- 削除ボタン -->
                        <td>
                            <form action="{{ url('action/'.$action->id)}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger py-0" onclick="return confirm('削除します。いいですか？')">  削除  </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection
@section('finish')
@parent
@endsection

@section('footer')
@parent
@endsection
