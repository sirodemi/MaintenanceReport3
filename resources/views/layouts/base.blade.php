<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <style>
        .footer{
            text-align: right;
            font-size: 10pt;
            margin: 10px;
            border-bottom: solid 1px #ccc;
            color: #ccc;
        }
        @media print{
                .NoPrint{ display: none;}
        }
    </style>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="/js/app.js"></script>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="/css/app.css" rel="stylesheet">
</head>

<body>
    <div class="header">
        @section('header')
        <nav class="nav">
            <a class="nav-link NoPrint" href="{{ url('/') }}">メニュー画面</a>
            <a class="nav-link" href="{{ url('/syoken') }}">所見選択画面（リセット）</a>
        </nav>
        @show
    </div>
    <div class="content">
        @yield('content')
    </div>
    <div class="footer">
        copyright 2021 sunyou.co.jp
        @yield('footer')
    </div>
</body>
</html>
