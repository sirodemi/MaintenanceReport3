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
        /* .footer{
            text-align: right;
            font-size: 10pt;
            margin: 10px;
            border-bottom: solid 1px #ccc;
            color: #ccc;
        } */
        @media print{
                .NoPrint{ display: none;}
        }

        body:after{
            position: absolute; /* 位置の相対指定 */
            right: 0; /* 右から０ピクセルの位置指定 */
            bottom: 0; /* 下から０ピクセルの位置指定 */
            color: #ccc;
            content: "copyright 2021 sunyou.co.jp";
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

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">所見管理</a>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/syoken') }}">所見選択画面（リセット）</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="history.back()">　　前に戻る</a>
                    </li>
                </ul>
            </div>
        </nav>

        @show
    </div>
    <div class="content">
        @yield('content')
    </div>
    <div class="footer">
        @yield('footer')
    </div>
</body>
</html>
