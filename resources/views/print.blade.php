@extends('layouts.base')
@section('title','印刷画面')
@section('header')
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

    .card{
        max-width: 80%;
        /* text-align: center; */
    }
</style>
@endsection

@section('content')

{{-- 印刷ボタン --}}
<button type="button" class="NoPrint" id="print-button">印刷</button>


<!-- 保存ボタン -->
<form action="{{ url('print_save')}}" method="POST" class="saveForm">
    @csrf
    <input type="hidden" name="saveData" id="saveData" value="dummy" />
    <button type="button" id="save-button" class="NoPrint">保存</button>
</form>

<br><br>

書式1
<table class="table table-bordered">
    <tbody>
        <tr>
            <th>工事名</th><td colspan="3" id="koujiMei">kojiMei data</td>
        </tr>
        <tr>
            <th>住所</th><td colspan="3" id="jusyo">jusyo data</td>
        </tr>
        <tr>
            <th>型式</th><td id="katasiki">katasiki data</td>
            <th>製造番号</th><td id="seizoBango">seizobango</td>
        </tr>
    </tbody>
</table>

書式2
<table class="table table-bordered">
    <tbody>
        <tr>
            <th>型式</th><td id="katasiki2">katasiki data</td>
            <th>製造年月</th><td id="seizoNengetu">seizonengetu data</td>
        </tr>
        <tr>
            <th>設置場所</th><td id="settiBasyo">settibasyo data</td>
            <th></th><td></td>
        </tr>
    </tbody>
</table>



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
    <div class="card mx-auto">
        <div class="card-body">
            <div class="card-header" id="{{$partID}}">[不良箇所]{{$part[$i]}}   </div>
            <p class="card-text" id="{{$commentID}}"> {{$comment[$i]}} </p>
            <p class="card-text" id="{{$actionID}}"> {{$action[$i]}} </p>
        </div>
    </div>
@endfor

<script type="module">

    // データベースからダウンロード
    var koujiData = '工事データ';
    var jusyoData = '住所データ';
    var katasikiData ='型式データ';
    var seizoBangoData = '製造番号データ';
    var seizoNengetuData = '製造年月データ';
    var settiBasyoData = '設置場所データ';

    // 概要へ代入する
    $('#koujiMei').html(koujiData);
    $('#jusyo').html(jusyoData);
    $('#katasiki').html(katasikiData);
    $('#katasiki2').html(katasikiData);
    $('#seizoBango').html(seizoBangoData);
    $('#seizoNengetu').html(seizoNengetuData);
    $('#settiBasyo').html(settiBasyoData);


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
console.log('143:',syoken_cnt);

        // 不良箇所、所見、処置のリスト取得
        var array_part = [];
        var array_comment = [];
        var array_action = [];
        for(var i=0; i<syoken_cnt; i++){
            array_part.push($('#part'+i).text().substr( 6 ).trim());
            array_comment.push($('#comment'+i).text().trim());
            array_action.push($('#action'+i).text().trim());
        }


console.log('160: ',array_part);
console.log('161: ',array_comment);
console.log('162: ',array_action);

        var array = [];
        for(var i=0; i<array_part.length; i++){
            array.push({"part":array_part[i],"comment":array_comment[i],"action":array_action[i]});
        }

        var jsonArray=JSON.stringify(array);
        $('#saveData').val(jsonArray);

console.log('169: ',jsonArray)

            // 送信ボタンクリック
        $('.saveForm').submit();
    });

</script>


@endsection
@section('footer')
@endsection




