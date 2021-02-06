@extends('layouts.base')
@section('title','関係性管理画面')
@section('header')
    @parent
@endsection

@section('top')
<div>[所見関係性]　登録・変更・削除</div>
@endsection


@section('content')


{{-- <div>  [所見　紐付け]　登録・変更・削除 </div> --}}
<br>

<!-- 関係性登録フォーム -->
<form action="{{ route('relation')}}" method="POST">
    {{csrf_field()}}

    <div class="container">
        <div class="row">
            <!-- 所見 -->
            <div class="col-9">
                所見<input type="text" name="comment" class="form-control">
            </div>

            <!-- 症状 -->
            <div class="col">
                症状<input type="text" name="syojo" class="form-control">
            </div>

            <!-- 不良箇所 -->
            <div class="col">
                箇所<input type="text" name="part" class="form-control">
            </div>

            <!-- 原因 -->
            <div class="col">
                原因<input type="text" name="cause" class="form-control">
            </div>
        </div>


        <!-- 登録ボタン -->
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary btn-block" style="margin-top: 10px">  登録  </button>
            </div>
        </div>
    </div>
</form>


<!-- 既に登録されてる関係性のリスト -->
@if(count($items_relation) > 0)
<div class="card-body">
    <div class="card-title"></div>
    <div class="card-body">
        <table class="table table-striped task-table table-sm">
            <!-- テーブルヘッダ -->
            <thead>
                <th>id</th>
                <th>所見</th>
                <th>症状</th>
                <th>箇所</th>
                <th>原因</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </thead>
            <!-- テーブル本体 -->
            <tbody>
                @foreach ($items_relation as $relation)
                    <tr>
                        <!-- id -->
                        <td class="table-text">
                            <div>{{$relation->id}}</div>
                        </td>

                        <!-- 関係性 -->
                        <td class="table-text">
                            <div>{{$relation->comment}}</div>
                        </td>

                        <!-- 症状 -->
                        <td class="table-text">
                            <div>{{$relation->syojo}}</div>
                        </td>

                        <!-- 不良箇所 -->
                        <td class="table-text">
                            <div>{{$relation->part}}</div>
                        </td>

                        <!-- 原因 -->
                        <td class="table-text">
                            <div>{{$relation->cause}}</div>
                        </td>

                        <!-- 更新ボタン -->
                        <td>
                            <form action="{{ url('relation_edit/'.$relation->id)}}" method="POST">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-primary py-0">  変更  </button>
                            </form>
                        </td>

                        <!-- 削除ボタン -->
                        <td>
                            <form action="{{ url('relation/'.$relation->id)}}" method="POST">
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
