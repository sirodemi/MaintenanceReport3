@extends('layouts.base')
@section('title','印刷画面')
@section('header')
    @parent

<style>
    /* 印刷プレビュー＆印刷用レイアウト */
    @media print,
    screen {
        body {
            margin: 0;
            width: 210mm;
            height: 297mm;
        }
    }

    .card-header{
        font-size: 26px;
    }

    .card{
        /* max-width: 90%; */
        /* text-align: center; */
        font-size: 20px;
    }

    body{
        margin:50px;
    }

    body:after{
        position: absolute; /* 位置の相対指定 */
        right: 0; /* 右から０ピクセルの位置指定 */
        bottom: 0; /* 下から０ピクセルの位置指定 */
        color: #ccc;
        content: "copyright 2021 sunyou.co.jp";
    }

    /* table > tbody > tr > th{
        border:1px solid black;
    }

    table > tbody > tr > td{
        border:1px solid black;
    } */



</style>
@endsection



@section('content')
<body>
<br>
<form action="{{ url('print_save')}}" method="POST" class="saveForm">
    @csrf
    {{-- 印刷ボタン --}}
    <button type="button" class="NoPrint" id="print-button">印刷</button>

    <!-- 保存ボタン -->
    <button type="button" class="NoPrint" id="save-button">保存</button>

    {{-- 保存データ --}}
    <input type="hidden" name="saveData" id="saveData" value="dummy" />

</form>



<br>
<p><h3>点検報告書</h3></p>
<br>

<!-- 書式1 -->
<!-- <table class="table table-bordered"> -->
<table border="1" width="100%" style="font-size: 14pt;table-layout: auto;">
    <tbody>
        <tr>
            <td width="10%">工事ID</td><td colspan="2" id="field_id" width="20%">{{$genfield->id}}</td>
            <td width="15%">工事名</td><td id="field_name" width="55%">{{$genfield->field_name}}</td>
        </tr>
        <tr>
            <td>住所</td><td colspan="4" id="field_address">{{$genfield->field_address}}</td>
        </tr>
        <tr>
            <td>型式</td><td colspan="2" id="katasiki">{{$general_set->set_model}}</td>
            <td>製造番号</td><td colspan="3" id="seizoBango">{{$general_set->set_serial_number}}</td>
        </tr>
    </tbody>
</table>

<br>
{{-- 書式2
<table border="1" width="100%" style="font-size: 14pt;table-layout: auto;">
    <tbody>
        <tr>
            <th>型式</th><td id="katasiki2">{{$general_set->set_model}}</td>
            <th>製造年月</th><td id="seizoNengetu">{{$general_set->set_manufacturing_date}}</td>
        </tr>
        <tr>
            <th>設置場所</th><td id="settiBasyo">{{$genfield->field_address}}</td>
            <th></th><td></td>
        </tr>
    </tbody>
</table>
<br> --}}


{{-- PrintControllerからデータを受け取って印刷内容を表示する --}}
{{-- 所見の数 --}}
@php
    $syoken_cnt = count($part);
@endphp
@for ($i = 0; $i < $syoken_cnt; $i++)
    @php
        $partID     = 'part'.$i;
        $commentID  = 'comment'.$i;
        $actionID   = 'action'.$i;
    @endphp
    <div class="card border-dark mx-auto">
        <div class="card-body">
            <div class="card-header" id="{{$partID}}">[不良箇所]{{$part[$i]}}   </div>
            <p class="card-text" id="{{$commentID}}">症状： {{$comment[$i]}} </p>
            <p class="card-text" id="{{$actionID}}">処置： {{$action[$i]}} </p>
        </div>
    </div>
@endfor

<script type="module">

    // // データベースからダウンロード
    // var kojiData = '工事データ';
    // var jusyoData = '住所データ';
    // var katasikiData ='型式データ';
    // var seizoBangoData = '製造番号データ';
    // var seizoNengetuData = '製造年月データ';
    // var settiBasyoData = '設置場所データ';

    // // 概要へ代入する
    // $('#kojiMei').html(kojiData);
    // $('#jusyo').html(jusyoData);
    // $('#katasiki').html(katasikiData);
    // $('#katasiki2').html(katasikiData);
    // $('#seizoBango').html(seizoBangoData);
    // $('#seizoNengetu').html(seizoNengetuData);
    // $('#settiBasyo').html(settiBasyoData);


    // 画面遷移せずに編集する(inline edit)
    $('.card-text').click(function(){

        if(!$(this).hasClass('on')){
            $(this).addClass('on');
            var txt = $(this).text();
            $(this).html('<input type="text" value="'+txt+'" />');
            $('.card-text > input').focus().blur(function(){
                var inputVal = $(this).val();
                if(inputVal===''){
                    inputVal = this.defaultValue;
                };
                $(this).parent().removeClass('on').text(inputVal);
            });
        };
    });


    // 印刷処理
    $(document).on('click', '#print-button', function(){
        $(function () {window.print();});
    });


    // 保存処理
    $(document).on('click', '#save-button', function(){

        // PHPの変数（所見の数）をjavascriptで取込む
        var syoken_cnt = <?php echo $syoken_cnt ?>;

        // 現場id情報取得
        var genfield_id = <?php echo $genfield->id ?>;
genfield_id=1;

        // 不良箇所、所見、処置のリスト取得
        var array_part = [];
        var array_comment = [];
        var array_action = [];
        for(var i=0; i<syoken_cnt; i++){
            array_part.push($('#part'+i).text().substr(6).trim());//[不良箇所]　削除
            array_comment.push($('#comment'+i).text().substr(4).trim());//[症状]　削除
            array_action.push($('#action'+i).text().substr(4).trim());//[処置]　削除
        }


        // 保存用jsonデータ作成
        var array = [];
        for(var i=0; i<array_part.length; i++){
            // array.push({"part":array_part[i], "comment":array_comment[i], "action":array_action[i], "genfield_id":genfield->id});
            array.push({"part":array_part[i], "comment":array_comment[i], "action":array_action[i], "genfield_id":genfield_id});
        }


        var jsonArray=JSON.stringify(array);
        $('#saveData').val(jsonArray);


console.log('208: ',jsonArray);

        // 送信ボタンクリック
        $('.saveForm').submit();
    });

</script>

</body>
@endsection

@section('finish')
@endsection

@section('footer')
@endsection




