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
            /* border-bottom: solid 1px #ccc; */
            color: #ccc;
        }
        @media print{
            .NoPrint{ display: none;}
        }

    </style>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- <script src="/js/app.js"></script> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link href="/css/app.css" rel="stylesheet"> -->
</head>

<body>
    <div class="header">
        @section('header')

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav">
                    {{-- @yield('top') --}}
                    <li class="nav-item">
                        <input type="text" id="genfieldID" name="genfieldID" class="form-control nav-link"  style="width: 100px" placeholder="現場ID">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">現場名</a>
                    </li>
                </ul>


                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">トップ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/syoken') }}">　　選択画面</a>
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
        @section('content')
            @yield('content')
        @show
    </div>
    <div class="finish">
        @section('finish')
            @yield('finish')
            <hr width="95%">
        @show
    </div>
    <div class="footer">
        @section('footer')
            @yield('footer')
            copyright 2021 sunyou.co.jp
        @show
    </div>



</body>
</html>
