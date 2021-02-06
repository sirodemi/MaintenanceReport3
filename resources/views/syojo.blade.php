@extends('layouts.base')
@section('title','症状管理画面')
@section('header')
    @parent
@endsection

@section('top')
<div>[症状]　登録・変更・削除</div>
@endsection

@section('content')

<br>
<!-- 症状登録フォーム -->
<div class="col-md-11 mb-1 ">
    <form action="{{ route('syojo')}}" method="POST" class="formhorizontal" >
        {{csrf_field()}}
        <label for="syojo" class="ml-2">症状追加</label>
        <div class="input-group mb-4 ml-4">
            <input type="text" name="syojo" id="syojo" class="form-control" placeholder="症状を追加" >
            <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">登録</button>
            </div>
        </div>
    </form>
</div>


<!-- 既に登録されてる症状のリスト -->
@if(count($items_syojo) > 0)
<div class="card-body">
    <div class="card-body">
        <table class="table table-striped task-table table-sm">
            <!-- テーブルヘッダ -->
            <thead>
                <th>A</th>
                <th>症状</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </thead>
            <!-- テーブル本体 -->
            <tbody>
                @foreach ($items_syojo as $syojo)
                    <tr>
                        <!-- id -->
                        <td class="table-text">
                            <div>{{$syojo->id}}</div>
                        </td>


                        <!-- 症状 -->
                        <td class="table-text">
                            <div>{{$syojo->syojo}}</div>
                        </td>



                        <!-- 更新ボタン -->
                        <td>
                            <form action="{{ url('syojo_edit/'.$syojo->id)}}" method="POST">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-secondary py-0">  変更  </button>
                            </form>
                        </td>



                        <!-- 削除ボタン -->
                        <td>
                            <form action="{{ url('syojo/'.$syojo->id)}}" method="POST">
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
