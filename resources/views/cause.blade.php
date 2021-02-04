@extends('layouts.base')
@section('title','原因管理画面')
@section('header')
    @parent
@endsection
@section('content')

<!-- Bootstrap の定形コード… -->
<div class="card-body">
    <div class="card-title">  [原因]　登録・変更・削除 </div>


    <!-- 原因登録フォーム -->
    <form action="{{ route('cause')}}" method="POST" class="formhorizontal">
        {{csrf_field()}}

        <!-- 原因 -->
        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" name="cause" class="form-control">
            </div>
        </div>

        <!-- 登録ボタン -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-primary">  登録  </button>
            </div>
        </div>
    </form>
</div>

<!-- 既に登録されてる原因のリスト -->
@if(count($items_cause) > 0)
<div class="card-body">
    <div class="card-title">  原因リスト  </div>
    <div class="card-body">
        <table class="table table-striped task-table table-sm">
            <!-- テーブルヘッダ -->
            <thead>
                <th>C</th>
                <th>原因</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </thead>
            <!-- テーブル本体 -->
            <tbody>
                @foreach ($items_cause as $cause)
                    <tr>
                        <!-- id -->
                        <td class="table-text">
                            <div>{{$cause->id}}</div>
                        </td>


                        <!-- 原因 -->
                        <td class="table-text">
                            <div>{{$cause->cause}}</div>
                        </td>



                        <!-- 更新ボタン -->
                        <td>
                            <form action="{{ url('cause_edit/'.$cause->id)}}" method="POST">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-primary py-0">  変更  </button>
                            </form>
                        </td>

                        <!-- 削除ボタン -->
                        <td>
                            <form action="{{ url('cause/'.$cause->id)}}" method="POST">
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
@section('footer')
    copyright 2021 Semantic-i
@endsection
