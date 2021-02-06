@extends('layouts.base')
@section('title','所見')

@section('header')
    @parent
@endsection

@section('top')
<div>所見選択</div>
@endsection


@section('content')

<style>
    td{
        padding:3px;
    }
    .whole{
        border-collapse:separate;
        border-spacing:50px;
    }
    .comment{
        /* width:90%; */
        /* margin: 10px 0px 0px 0px; */
    }

</style>


<body>
    <table class="whole">

        {{-- {{-- 症状リスト一覧表示 -- 内容はjavascriptで作成}} --}}
        <td valign="top" >
            <table border="1" id="table_syojo">
            </table>
        </td>


        {{-- 不良箇所一覧表示 --}}
        <td valign="top">
            <table border="1" id="table_part">
            </table>
        </td>


        {{-- 原因一覧表示 --}}
        <td valign="top">
            <table border="1" id="table_cause">
            </table>
        </td>
    </table>


    {{---------------------------------
    印刷ボタン[POST]　個数のバッジ付き
    ---------------------------------}}
    <div class="container-fluid">
        <div class="row">
            <div class="button-wrapper col-7">

                {{-- ボタンclick時の動作は下段のscriptに記載 --}}
                <form action="{{ url('print')}}" method="POST" class="printForm">
                    @csrf
                    <input type="submmit" class="btn btn-secondary" id="print-button" value="印刷ボタン">

                    {{-- 所見の個数表示 --}}
                    <a>　　　所見の数：</a>
                    <span class="badge badge-secondary" id="bag-num" style="font-size :12pt;">0</span>

                    {{-- 下段のscriptで引き渡す値をvalueに代入。それまではdummy --}}
                    <input type="hidden" id="syoken" name="syoken" value="dummy">
                    {{-- <input type="hidden" id="comment" name="comment" value="dummy">
                    <input type="hidden" id="action" name="action" value="dummy"> --}}
                </form>
            </div>

            <div class="col-4">
                <form action="/syoken_save" method="POST">
                    @csrf

                    {{-- <input>タグ　保存の値はjavascriptで後で設定 --}}
                    <div id="bag-save"></div>

                    {{-- <button type="submit" class="btn btn-secondary col-4">保存</button> --}}
                </form>
            </div>
        </div>
    </div>

    <table class="whole">
        {{-- 所見一覧表示 --}}
        <td valign="top" >
            <table border="1" id="table_comment" class="comment">
            </table>
        </td>

        {{-- 処置一覧表示 --}}
        <td valign="top" >
            <div  id="table_action">
            </div>
        </td>
    </table>


    <script type="module">

        ///////////////////////////////////////////////////////////
        // グローバル変数
        ///////////////////////////////////////////////////////////

        // clickされたセルのID
        var clickedCellID_syojo     = 0;
        var clickedCellID_part      = 0;
        var clickedCellID_cause     = 0;
        var clickedCellID_comment   = 0;
        var clickedCellID_action    = 0;

        // [controller]からデータベースの内容を受け取る
        var items_syojo             = @json($items_syojo);
        var items_part              = @json($items_part);
        var items_cause             = @json($items_cause);
        var items_comment           = @json($items_comment);
        var items_action            = @json($items_action);
        var items_actionRelation    = @json($items_actionRelation);

        // 灰色のリスト（候補リスト。上段に表示。）
        var itemsGray_syojo     = [];
        var itemsGray_part      = [];
        var itemsGray_cause     = [];
        var itemsGray_comment   = [];
        var itemsGray_action    = [];

        // 白色のリスト（候補ではないリスト。下段に表示。）
        var itemsWhite_syojo    = [];
        var itemsWhite_part     = [];
        var itemsWhite_cause    = [];
        var itemsWhite_comment  = [];
        var itemsWhite_action   = [];

        // 灰色を上部に白色を下部に表示するリスト。clickされてない時の為にデータを入れておく。
        var itemsMatch_syojo    = items_syojo;
        var itemsMatch_part     = items_part;
        var itemsMatch_cause    = items_cause;
        var itemsMatch_comment  = items_comment;
        var itemsMatch_action   = [];

        // 候補（灰色にする）リスト
        var candy=[];

        // 灰色にするテーブル毎のID
        var grayID_syojo=[];
        var grayID_part=[];
        var grayID_cause=[];

        // 所見印刷リスト
        var syoken_print_bag = [];


        ///////////////////////////////////////////////////////////
        // 初期画面
        ///////////////////////////////////////////////////////////

        // テーブル表示
        table_display(items_syojo, items_part, items_cause, items_comment);


        ///////////////////////////////////////////////////////////
        // セルがclickされたら
        ///////////////////////////////////////////////////////////
        $(document).on('click', '.chara', function(){

            // clickされたテーブル名を取得(table_syojo,table_part,table_cause,table_comment)
            var clicked_tableName = $(this).children('td')[0].innerText;

// console.log('199: ',clicked_tableName);

            // clickされたidを取得する
            var clicked_id = Number($(this).children('th')[0].innerText);

// console.log('204: ',clicked_id);
            //////////////////////////////////////////////////////////////////////
            // click -> 所見以外　の場合
            //////////////////////////////////////////////////////////////////////
            if(clicked_tableName != 'R'){

                //////////////////////////////////////////////////////////////////////
                // click -> 背景色が白　の場合
                //////////////////////////////////////////////////////////////////////
                // if($(this).css("background-color") == "rgb(255, 255, 255)"){

                if($(this).css("background-color") == "rgba(0, 0, 0, 0)"){


                    // 初期状態にリセットする（背景色・文字色・クリックリスト[clickedCellID]・候補リスト[candy]）
                    tableReset();

                    // clickされたリストを作成
                    make_clickedCellID(clicked_tableName,clicked_id);


                    // 候補リストを作成
                    makeCandy();

                    // 候補リストにある配列を作成する（灰色）
                    makeGrayArray();

                    // 候補リストに無い配列を作成する（白色）
                    makeWhiteArray();

                    // 灰色を上部に白色を下部にしたリスト
                    makeMatchTable();


                    // <所見>候補リストにある配列を作成する（灰色）
                    makeGrayArray_comment();

                    // <所見>候補リストにない配列を作成する（白色）
                    makeWhiteArray_comment();

                    // <所見>灰色を上部に白色を下部にしたリスト
                    makeMatchTable_comment();


                    // 上部が灰色、下部が白色の配列を表示する
                    table_display(itemsMatch_syojo, itemsMatch_part, itemsMatch_cause, itemsMatch_comment);


                    // 候補リストに該当する行を灰色にする<所見>も含む
                    graying_candyRow();


                    // 所見テーブルの該当行の背景を黒にする
                    makeBlack_commentTable();


                }else if($(this).css("background-color") == "rgb(128, 128, 128)"){
                //////////////////////////////////////////////////////////////////////
                // click -> 背景色が灰色　の場合
                //////////////////////////////////////////////////////////////////////

                    // clickされたリストを作成
                    make_clickedCellID(clicked_tableName,clicked_id);

                    // 候補リストを作成
                    makeCandy();

                    // 候補リストにある配列を作成する（灰色）
                    makeGrayArray();

                    // 候補リストに無い配列を作成する（白色）
                    makeWhiteArray();

                    // 灰色を上部に白色を下部にしたリスト
                    makeMatchTable();



                    // <所見>候補リストにある配列を作成する（灰色）
                    makeGrayArray_comment();

                    // <所見>候補リストにない配列を作成する（白色）
                    makeWhiteArray_comment();

                    // <所見>灰色を上部に白色を下部にしたリスト
                    makeMatchTable_comment();


                    // 上部が灰色、下部が白色の配列を表示する
                    table_display(itemsMatch_syojo, itemsMatch_part, itemsMatch_cause, itemsMatch_comment);

                    // 候補リストに該当する行を灰色にする
                    graying_candyRow();
                }

            }else{
            //////////////////////////////////////////////////////////////////////
            // click -> 所見　の場合
            //////////////////////////////////////////////////////////////////////


                //////////////////////////////////////////////////////////////////////
                // click -> 黒色以外　の場合
                //////////////////////////////////////////////////////////////////////
                if($(this).css("background-color") != "rgb(0, 0, 0)"){

                    // 所見印刷リストに追加
                    syoken_print_bag.push({
                        "syoken_id" :items_comment[clicked_id - 1].id,
                        "action_id" :0,
                        "part_id"   :items_comment[clicked_id - 1].part,
                    });


                    // 所見テーブルの該当行の背景を黒にする
                    makeBlack_commentTable();


                    // 印刷ボタンに所見リストの個数をつける
                    $('#bag-num').html(syoken_print_bag.length);


                    // 所見印刷リストをidの昇順に並び替え
                    syoken_print_bag.sort(function(a, b) {
                    if (a.syoken_id > b.syoken_id) {
                        return 1;
                    } else {
                        return -1;
                    }
                    })



                    //////////////////////////////////////////////////////////////////////
                    // 処置テーブル表示
                    //////////////////////////////////////////////////////////////////////
                    makeActionTable(syoken_print_bag);

                    // 処置テーブルに黒の行を表示する
                    makeBlack_actionTable();


                //////////////////////////////////////////////////////////////////////
                // click -> 黒色　の場合
                //////////////////////////////////////////////////////////////////////
                }else{

console.log('black click!');

                    // 上部が灰色、下部が白色の配列を表示する
                    table_display(itemsMatch_syojo, itemsMatch_part, itemsMatch_cause, itemsMatch_comment);


                    // テーブル背景色（白色）と文字色（黒色）にする
                    $('.chara').css({"background-color": "white","color": "black"});

                    // 候補リストに該当する行を灰色にする<所見>も含む
                    graying_candyRow();

                    // filter用にclicked_idを配列にする
                    var temp=[];
                    temp.push(clicked_id);

                    // キャンセルを所見リストから削除する
                    syoken_print_bag = syoken_print_bag.filter(x => !temp.includes(x.syoken_id));


                    // 所見リストのデータに基づき背景を黒にする
                    for(var i=0; i<syoken_print_bag.length; i++){
                        makeBlack('table_comment',syoken_print_bag[i].syoken_id);
                    }


                    // 印刷ボタンに所見リストの個数をつける
                    $('#bag-num').html(syoken_print_bag.length);


                    // 処置テーブル表示
                    makeActionTable(syoken_print_bag);


                    // 処置テーブルに黒の行を表示する
                    makeBlack_actionTable();
                }
            }
        });



        ////////////////////////////////////////////////////////////
        // click -> 処置テーブル　　*テーブルに[class='action']を設定している
        ////////////////////////////////////////////////////////////
        $(document).on('click', '.action', function(){


            // clickされたテーブル名を取得
            var clicked_tableName = $(this).children('td')[0].innerText;
// console.log('443:tableName: ',clicked_tableName);

            // clickされたidを取得する
            var clicked_id = Number($(this).children('th')[0].innerText);
// console.log('447:clicked_id: ',clicked_id);


            // clickされたidを[syoken_print_bag]に登録
            for(var i=0; i<syoken_print_bag.length; i++){
                if(syoken_print_bag[i].syoken_id == clicked_tableName){
                    syoken_print_bag[i].action_id = clicked_id;
                }
            }

console.log('465:syoken_print_bag: ',syoken_print_bag);

            // 処置テーブルに黒の行を表示する
            makeBlack_actionTable();

        });



        ////////////////////////////////////////////////////////////
        // 印刷処理
        ////////////////////////////////////////////////////////////

        $('#print-button').click(function () {

            var array = [];
            var item_part;
            var item_comment;
            var item_action;

            for(var i=0;i<syoken_print_bag.length;i++){
                item_part = items_part[syoken_print_bag[i].part_id-1].part;
                item_comment = items_comment[syoken_print_bag[i].syoken_id-1].comment;
                if(syoken_print_bag[i].action_id == 0){
                    if (confirm('注意）\n\n「'+items_comment[syoken_print_bag[i].syoken_id-1].comment+'」\n\nに対応する[処置]が空白のままです。')){
                        var item_action='';
                    }else{
                        return false;
                    }
                }else{
                    item_action = items_action[syoken_print_bag[i].action_id-1].action;
                }
                array.push({"part":item_part,"comment":item_comment,"action":item_action});
            }

            var jsonArray=JSON.stringify(array);
            $('#syoken').val(jsonArray);

            // 送信ボタンクリック
            $('.printForm').submit();
        });



        ///////////////////////////////////////////////////////////
        // 初期状態にリセットする
        ///////////////////////////////////////////////////////////
        function tableReset(){

            // テーブル背景色（白色）と文字色（黒色）を初期状態に戻す
            $('.chara').css("background-color","white");
            $('.chara').css("color","black");

            // clickされたセルのID
            clickedCellID_syojo = 0;
            clickedCellID_part  = 0;
            clickedCellID_cause = 0;
            clickedCellID_comment = 0;

            // [候補リスト]をリセットする
            candy.length = 0;

        }



        ///////////////////////////////////////////////////////////
        // テーブル表示
        ///////////////////////////////////////////////////////////
        function table_display(tableData_syojo, tableData_part, tableData_cause, tableData_comment){

            // 症状テーブル
            var html='';
            html+=`<tr align="center">
                <th>A</th>
                <th>症状</th>
            </tr>`;
            for( var i=0; i<tableData_syojo.length; i++){
                html += `<tr class="chara"><td hidden>A</td><th>`;
                html += tableData_syojo[i].id;
                html += `</th><td>`;
                html += tableData_syojo[i].syojo;
                html += `</td></tr>`;
            }
            $('#table_syojo').html(html);

            // 不良箇所テーブル
            var html='';
            html+=`<tr align="center">
                <th>B</th>
                <th>症不良箇所</th>
            </tr>`;
            for( var i=0; i<tableData_part.length; i++){
                html += `<tr class="chara"><td hidden>B</td><th>`;
                html += tableData_part[i].id;
                html += `</th><td>`;
                html += tableData_part[i].part;
                html += `</td></tr>`;
            }
            $('#table_part').html(html);

            // 原因テーブル
            var html='';
            html+=`<tr align="center">
                <th>C</th>
                <th>原因</th>
            </tr>`;
            for( var i=0; i<tableData_cause.length; i++){
                html += `<tr class="chara"><td hidden>C</td><th>`;
                html += tableData_cause[i].id;
                html += `</th><td>`;
                html += tableData_cause[i].cause;
                html += `</td></tr>`;
            }
            $('#table_cause').html(html);

            // 所見テーブル
            var html='';
            html+=`<tr align="center">
                <th>id</th>
                <th>所見</th>
            </tr>`;
            for( var i=0; i<tableData_comment.length; i++){
                html += `<tr class="chara comment"><td hidden>R</td><th>`;
                html += tableData_comment[i].id;
                html += `</th><td>`;
                html += tableData_comment[i].comment;
                html += `</td></tr>`;
            }
            $('#table_comment').html(html);

        }



        ////////////////////////////////////////////////////////////
        // クリックリスト作成
        ////////////////////////////////////////////////////////////
        function make_clickedCellID(clicked_tableName,clicked_id){
            switch(clicked_tableName){
                case 'A':
                    clickedCellID_syojo = clicked_id;
                    break;

                case 'B':
                    clickedCellID_part = clicked_id;
                    break;

                case 'C':
                    clickedCellID_cause = clicked_id;
                    break;

                case 'R':
                    clickedCellID_comment = clicked_id;
                    break;

                default:
                    break;
            }
        }



        ////////////////////////////////////////////////////////////
        // 候補リスト[candy]を作る
        ////////////////////////////////////////////////////////////
        function makeCandy(){
            candy.length = 0;
            for(var i=0; i<items_comment.length; i++){
                if((clickedCellID_syojo == items_comment[i].syojo|clickedCellID_syojo == 0)&
                    (clickedCellID_part == items_comment[i].part|clickedCellID_part == 0)&
                    (clickedCellID_cause == items_comment[i].cause|clickedCellID_cause == 0)){
                    candy.push({"syojo":items_comment[i].syojo, "part":items_comment[i].part, "cause":items_comment[i].cause});
                }
            }
console.log('563:candy ',candy)
        }



        ////////////////////////////////////////////////////////////
        // 候補リスト[candy]に基づいて灰色だけの配列を作成する
        ////////////////////////////////////////////////////////////
        function makeGrayArray(){
            grayID_syojo=[];
            grayID_part=[];
            grayID_cause=[];
            for(var i=0; i<candy.length; i++){
                grayID_syojo.push(Number(candy[i].syojo));
                grayID_part.push(Number(candy[i].part));
                grayID_cause.push(Number(candy[i].cause));
            }

            // 灰色のIDと元のデータのIDが一致するデータを抽出
            itemsGray_syojo = items_syojo.filter(x => grayID_syojo.includes(x.id));
            itemsGray_part  = items_part.filter(x => grayID_part.includes(x.id));
            itemsGray_cause = items_cause.filter(x => grayID_cause.includes(x.id));

        }



        ////////////////////////////////////////////////////////////
        // 候補リスト[candy]に基づいて白色だけの配列を作成する
        ////////////////////////////////////////////////////////////
        function makeWhiteArray(){
            var grayID_syojo=[];
            var grayID_part=[];
            var grayID_cause=[];
            for(var i=0; i<candy.length; i++){
                grayID_syojo.push(Number(candy[i].syojo));
                grayID_part.push(Number(candy[i].part));
                grayID_cause.push(Number(candy[i].cause));
            }
            itemsWhite_syojo = items_syojo.filter(x => !grayID_syojo.includes(x.id));
            itemsWhite_part = items_part.filter(x => !grayID_part.includes(x.id));
            itemsWhite_cause = items_cause.filter(x => !grayID_cause.includes(x.id));
        }



        ////////////////////////////////////////////////////////////
        // 候補リストに基づいて灰色が上部、白色が下部の配列を作成する
        ////////////////////////////////////////////////////////////
        function makeMatchTable(){
            itemsMatch_syojo = itemsGray_syojo.concat(itemsWhite_syojo);
            itemsMatch_part = itemsGray_part.concat(itemsWhite_part);
            itemsMatch_cause = itemsGray_cause.concat(itemsWhite_cause);
        }



        ////////////////////////////////////////////////////////////
        // <所見>候補リストに基づいて灰色だけの配列を作成する
        ////////////////////////////////////////////////////////////
        function makeGrayArray_comment(){
            itemsGray_comment = items_comment.filter(x => grayID_syojo.includes(Number(x.syojo)));
            itemsGray_comment = itemsGray_comment.filter(x => grayID_part.includes(Number(x.part)));
            itemsGray_comment = itemsGray_comment.filter(x => grayID_cause.includes(Number(x.cause)));
        }



        ////////////////////////////////////////////////////////////
        // <所見>候補リストに基づいて白色だけの配列を作成する
        ////////////////////////////////////////////////////////////
        function makeWhiteArray_comment(){
            var itemsGray_commentID = [];
            for(var i=0; i<itemsGray_comment.length;i++){
                itemsGray_commentID.push(itemsGray_comment[i].id);
            }
            itemsWhite_comment = items_comment.filter(x => !itemsGray_commentID.includes(x.id));
        }



        ////////////////////////////////////////////////////////////
        // <所見>候補リストに基づいて灰色が上部、白色が下部の配列を作成する
        ////////////////////////////////////////////////////////////
        function makeMatchTable_comment(){
            itemsMatch_comment = itemsGray_comment.concat(itemsWhite_comment);
        }



        ////////////////////////////////////////////////////////////
        // 候補リストのセルを灰色にする
        ////////////////////////////////////////////////////////////
        function makeGrayCell(grayCell){
            for(var j=0; j<grayCell.length; j++){
                for(var i=0; i<items_syojo.length; i++){
                    if(items_syojo[i].id == grayCell[j].syojo){
                        makeGray('table_syojo', i+1);
                    }
                }

                for(var i=0; i<items_part.length; i++){
                    if(items_part[i].id == grayCell[j].part){
                        makeGray('table_part', i+1);
                    }
                }

                for(var i=0; i<items_cause.length; i++){
                    if(items_cause[i].id == grayCell[j].cause){
                        makeGray('table_cause', i+1);
                    }
                }
            }
        }



        ////////////////////////////////////////////////////////////
        // [候補リスト]と[クリックリスト]が合致したテーブルの行を灰色にする
        ////////////////////////////////////////////////////////////
        function graying_candyRow(){
            for(var i=0; i<itemsGray_syojo.length; i++){
                makeGray('table_syojo',i+1);
            }
            for(var i=0; i<itemsGray_part.length; i++){
                makeGray('table_part',i+1);
            }
            for(var i=0; i<itemsGray_cause.length; i++){
                makeGray('table_cause',i+1);
            }
            for(var i=0; i<itemsGray_comment.length; i++){
                makeGray('table_comment',i+1);
            }
        }



        ////////////////////////////////////////////////////////////
        // click -> 所見テーブル　-> 処置データを選定してテーブルを表示する
        ////////////////////////////////////////////////////////////
        function makeActionTable(syokenBag){

            // 表示場所を一度削除する
            $('#table_action').empty();


            // 所見テーブルを基にして処置テーブルを作成
            for(var i=0; i<syokenBag.length; i++){
                var actionRelation_actionID=[];
                for(var j=0; j<items_actionRelation.length; j++){
                    if(items_actionRelation[j].comment_id == syokenBag[i].syoken_id){
                        actionRelation_actionID.push(Number(items_actionRelation[j].action_id));
                    }
                }

                itemsMatch_action = items_action.filter(x => actionRelation_actionID.includes(x.id));

                actionTable_display(itemsMatch_action,syokenBag[i].syoken_id);
            }
        }



        ///////////////////////////////////////////////////////////
        // 処置テーブル表示
        ///////////////////////////////////////////////////////////
        function actionTable_display(tableData_action,syoken_id){
            // 処置テーブル
            var html='';
            html += `<table border="1" id=`;
            html += syoken_id;
            html += `>`;
            html+=`<tr align="center">`;
            html += `<th>id</th>
                <th>処置（所見ID: `;
            html += syoken_id;
            html += ` ）</th></tr>`;
            for( var i=0; i<tableData_action.length; i++){
                html += `<tr class="action"><td hidden>`;
                html += syoken_id;
                html +=`</td><th>`;
                html += tableData_action[i].id;
                html += `</th><td>`;
                html += tableData_action[i].action;
                html += `</td></tr>`;
            }
            html += `<tr><td></td><td></td></tr>`;
            html += `<table>`;
            $('#table_action').append(html);
        }



        ////////////////////////////////////////////////////////////
        // 背景色を灰色、文字を黒色に着色
        ////////////////////////////////////////////////////////////
        function makeGray(table_id, row){
            // 色つけ対象のtable
            var coloringTable  = document.getElementById(table_id);
            // 色つけ対象の行
            var coloringRow = coloringTable.rows[row];

            coloringRow.style.backgroundColor = "gray";
            coloringRow.style.color = "white";
        }



        ////////////////////////////////////////////////////////////
        // 背景色を黒色、文字を黒色に着色
        ////////////////////////////////////////////////////////////
        function makeBlack(table,row){

            // 色つけ対象のtable
            var coloringTable  = document.getElementById(table);

            // 色つけ対象の行
            var coloringRow = coloringTable.rows[row];

            // 対象行の背景色は灰色で文字は白色
            coloringRow.style.backgroundColor = "black";
            coloringRow.style.color = "white";
        }



        ////////////////////////////////////////////////////////////
        // 処置テーブルに黒の行を表示する
        ////////////////////////////////////////////////////////////
        function makeBlack_actionTable(){

            // 処置テーブルのidとclickのidが一致するものを探す
            for(var j=0; j<syoken_print_bag.length; j++){

                // 処置テーブルの個数をカウント(trタグのタイトルと接続用の空白行を個数から引く)
                var $trTag = $("#" + syoken_print_bag[j].syoken_id+' tr');

                for(var i=0; i<$($trTag).length-2; i++){
                    var clickID = syoken_print_bag[j].action_id;
                    if(clickID !=0){

                        // 所見idと一致するactionテーブルを選択
                        var $selector = $("#" + syoken_print_bag[j].syoken_id+' tr.action');
                        var actionID = $($selector).eq(i).children('th')[0].innerText;

                        // actionテーブルのidとclickしたidの一致を探して背景を黒にする
                        if(clickID == actionID){
                            $($selector).eq(i).css({"color":"white","background-color":"black"});
                        }
                    }
                }
            }
        }



        ////////////////////////////////////////////////////////////
        // 所見テーブルに黒の行を表示する
        ////////////////////////////////////////////////////////////
        function makeBlack_commentTable(){

            // 所見テーブルのidとclickのidが一致するものを探す
            for(var j=0; j<syoken_print_bag.length; j++){
                for(var i=0; i<items_comment.length; i++){

                    // 所見リストに登録されている所見idを取得
                    var clickID = syoken_print_bag[j].syoken_id;

                    // 所見リスト一覧の所見idを取得
                    var commentID = $('#table_comment').find('th')[i+2].innerText;

                    // 所見テーブルのidとclickしたidの一致を探して背景を黒にする
                    if(clickID == commentID){
                        $('.chara.comment').eq(i).css({"color":"white","background-color":"black"});
                    }
                }
            }
        }


    </script>
</body>
@endsection

@section('finish')
@parent
@endsection

@section('footer')
@parent
@endsection

