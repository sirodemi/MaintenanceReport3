@extends('layouts.base')
@section('title','原因編集')
@section('content')

<div class="row">
    <div class="col-md-12">
        <form action="{{ url('cause/update')}}" method="POST">
            <!-- item_name -->
            <div class="form-group">
                <label for="item_name">Title</label>
                <input type="text" name="cause" class="form-control"  value="{{$cause->cause}}">
            </div>


            <!-- Save ボタン/Back ボタン -->
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link pull-right" href="{{ route('cause') }}">  Back  </a>
            </div>

            <!-- id値を送信 -->
            <input type="hidden" name="id" value="{{$cause->id}}" />

            <!-- CSRF -->
            {{csrf_field()}}

        </form>
    </div>
</div>

@endsection
@section('footer')
@endsection
