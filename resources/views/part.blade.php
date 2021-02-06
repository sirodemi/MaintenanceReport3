@extends('layouts.base')
@section('title','不良箇所管理画面')
@section('header')
    @parent
@endsection

@section('top')
<div>[不良箇所]　登録・変更・削除 </div>
@endsection

@section('content')

<br>
<!-- 不良箇所登録フォーム -->
<div class="col-md-11 mb-1 ">
    <form action="{{ route('part')}}" method="POST" class="formhorizontal">
        {{csrf_field()}}
        <label for="part" class="ml-2">不良箇所追加</label>
        <div class="input-group mb-4 ml-4">
            <input type="text" name="part" id="part" class="form-control" placeholder="不良箇所を追加" >
            <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">登録</button>
            </div>
        </div>
    </form>
</div>


{{-- <br>
<!-- 原因登録フォーム -->
<div class="col-md-11 mb-1 ">
    <form action="{{ route('cause')}}" method="POST" class="formhorizontal">
        {{csrf_field()}}
        <label for="action" class="ml-2">原因追加</label>
        <div class="input-group mb-4 ml-4">
            <input type="text" name="cause" id="cause" class="form-control" placeholder="原因を追加" >
            <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">登録</button>
            </div>
        </div>
    </form>
</div>
 --}}



<!-- 既に登録されてる不良箇所のリスト -->
@if(count($items_part) > 0)
<div class="card-body">
    <div class="card-body">
        <table class="table table-striped task-table table-sm">
            <!-- テーブルヘッダ -->
            <thead>
                <th>B</th>
                <th>不良箇所</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </thead>
            <!-- テーブル本体 -->
            <tbody>
                @foreach ($items_part as $part)
                    <tr>
                        <!-- id -->
                        <td class="table-text">
                            <div>{{$part->id}}</div>
                        </td>


                        <!-- 不良箇所 -->
                        <td class="table-text">
                            <div>{{$part->part}}</div>
                        </td>



                        <!-- 更新ボタン -->
                        <td>
                            <form action="{{ url('part_edit/'.$part->id)}}" method="POST">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-secondary py-0">  変更  </button>
                            </form>
                        </td>



                        <!-- 削除ボタン -->
                        <td>
                            <form action="{{ url('part/'.$part->id)}}" method="POST">
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
