@extends('layouts.base')
@section('title','症状編集')

@section('top')
<div>[症状編集]</div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <form action="{{ url('part/update')}}" method="POST">
            <!-- item_name -->
            <div class="form-group">
                <label for="item_name">Title</label>
                <input type="text" name="part" class="form-control"  value="{{$part->part}}">
            </div>


            <!-- Save ボタン/Back ボタン -->
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link pull-right" href="{{ route('part') }}">  Back  </a>
            </div>

            <!-- id値を送信 -->
            <input type="hidden" name="id" value="{{$part->id}}" />

            <!-- CSRF -->
            {{csrf_field()}}

        </form>
    </div>
</div>

@endsection
@section('finish')
@parent
@endsection

@section('footer')
@parent
@endsection
