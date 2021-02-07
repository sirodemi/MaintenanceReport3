@extends('layouts.base')
@section('title','不良箇所管理画面')
@section('header')
    @parent
@endsection

@section('top')
<div>所見データ</div>
@endsection

@section('content')

    {{-- @foreach($syokenItems as $syokenItem)
        {{$syokenItem}};
    @endforeach --}}
<br>
<table class="table table-sm table-bordered">
    <thead>
        <tr>
            {{-- <th>工事ID</th> --}}
            <th>所見id</th>
            <th>工事名</th>
            <th>型式</th>
            <th>不良箇所</th>
            <th>所見</th>
            <th>処置</th>
            <th>更新日</th>
        </tr>
    </thead>
    <tbody>
    @foreach($syokenItems as $syokenItem)
        <tr>
            {{-- <td id="field_id">{{$syokenItem->genfield_id}}</td> --}}
            <td id="report_id">{{$syokenItem->report_id}}</td>
            <td id="field_name">{{$syokenItem->genfield->field_name}}</td>
            <td id="katasiki">katasiki data</td>
            <td id="part">{{$syokenItem->part}}</td>
            <td id="comment">{{$syokenItem->comment}}</td>
            <td id="action">{{$syokenItem->action}}</td>
            <td id="updated">{{$syokenItem->created_at->format('Y/m/d H:i:s')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>




@endsection

@section('finish')
@parent
@endsection

@section('footer')
@parent
@endsection
