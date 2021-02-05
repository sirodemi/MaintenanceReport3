@extends('layouts.base')
@section('title','関係性編集')
@section('content')


<form action="{{ url('relation/update')}}" method="POST">
    {{ csrf_field() }}

    <div class="container">
        <div class="row">

            <!-- 所見 -->
            <div class="col-9">
                所見<input type="text" name="comment" class="form-control"  value="{{$comment->comment}}">
            </div>

            <!-- 症状 -->
            <div class="col">
                症状<input type="text" name="syojo" class="form-control" value="{{$comment->syojo}}">
            </div>

            <!-- 不良箇所 -->
            <div class="col">
                箇所<input type="text" name="part" class="form-control"  value="{{$comment->part}}">
            </div>

            <!-- 原因 -->
            <div class="col">
                原因<input type="text" name="cause" class="form-control"  value="{{$comment->cause}}">
            </div>
        </div>

        <!-- Save ボタン/Back ボタン -->
        <div class="row">
            <button type="button" onclick="history.back()" class="btn btn-outline-primary col" style="margin: 10px 0px 0px 15px">戻る</button>
            <button type="submit" class="btn btn-primary col-10" style="margin: 10px 0px 0px 15px">変更</button>
        </div>

        <!-- id値を送信 -->
        <input type="hidden" name="id" value="{{$comment->id}}" />

    </div>
</form>

@endsection
@section('finish')
@endsection

@section('footer')
@parent
@endsection
