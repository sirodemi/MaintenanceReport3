@extends('layouts.base')
@section('title','不良箇所管理画面')
@section('header')
    @parent
@endsection

@section('top')
<div>所見データ</div>
@endsection

@section('content')


{{-- {{$syokenItems}} --}}

    {{-- @foreach($syokenItems as $syokenItem)
        {{$syokenItem}}
        {{$syokenItem->genfield->field_name}}
    @endforeach --}}

@php
    $reportItems = json_decode($reportItem_jsonset);
@endphp

{{-- {{$reportItems->b}} --}}
{{-- {{$reportItems[0]->report_id}} --}}

<br>
<table class="table table-sm table-bordered">
    <thead>
        <tr>
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


<br>
<table class="table table-sm table-bordered">
    <thead>
        <tr>
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
    @foreach($reportItems as $reportItem)
        <tr>
            <td id="report_id_2">{{$reportItem->report_id}}</td>
            <td id="field_name_2">{{$syokenItems[0]->genfield->field_name}}</td>
            <td id="katasiki_2">katasiki data</td>
            <td id="part_2">{{$reportItem->part}}</td>
            <td id="comment_2">{{$reportItem->comment}}</td>
            <td id="action_2">{{$reportItem->action}}</td>
            <td id="updated_2">{{$reportItem->created_at}}</td>
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
