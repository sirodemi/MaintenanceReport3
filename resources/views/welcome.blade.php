@extends('layouts.base')
@section('title','メニュー画面')
@section('header')
<style>
html, body {
    background-color: #fff;
    color: #636b6f;
    font-family: 'Nunito', sans-serif;
    font-weight: 200;
    height: 100vh;
    margin: 0;
}

.full-height {
    height: 80vh;
}

.flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
}

.position-ref {
    position: relative;
}

.top-right {
    position: absolute;
    right: 10px;
    top: 18px;
}

.content {
    text-align: center;
}

.title {
    font-size: 84px;
}

.links > a {
    color: #636b6f;
    padding: 0 25px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: .1rem;
    text-decoration: none;
    text-transform: uppercase;
}

.m-b-md {
    margin-bottom: 30px;
}
</style>
@endsection

@section('content')
<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                所見管理
            </div>

            <div class="links" >
                <a href="{{ url('/syoken') }}"      style="font-size: 12pt;">メイン画面</a>
                <a href="{{ url('/syojo') }}"       style="font-size: 12pt;">症状管理画面</a>
                <a href="{{ url('/part') }}"        style="font-size: 12pt;">不良箇所管理画面</a>
                <a href="{{ url('/cause') }}"       style="font-size: 12pt;">原因管理画面</a>
                <a href="{{ url('/action') }}"      style="font-size: 12pt;">処置管理画面</a>
                <a href="{{ url('/relation') }}"    style="font-size: 12pt;">関係管理画面</a>
            </div>
        </div>
    </div>
</body>
@endsection

@section('footer')
@endsection
