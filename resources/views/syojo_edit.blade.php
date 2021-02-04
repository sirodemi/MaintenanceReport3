@extends('layouts.base')
@section('title','症状編集')
@section('content')

<div class="row">
    <div class="col-md-12">
        <form action="{{ url('syojo/update')}}" method="POST">
            <!-- item_name -->
            <div class="form-group">
                <label for="item_name">Title</label>
                <input type="text" name="syojo" class="form-control"  value="{{$syojo->syojo}}">
            </div>


            <!-- Save ボタン/Back ボタン -->
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link pull-right" href="{{ route('syojo') }}">  Back  </a>
            </div>

            <!-- id値を送信 -->
            <input type="hidden" name="id" value="{{$syojo->id}}" />

            <!-- CSRF -->
            {{csrf_field()}}

        </form>
    </div>
</div>

@endsection
@section('footer')
    copyright 2021 Semantic-i
@endsection
