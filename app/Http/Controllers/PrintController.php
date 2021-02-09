<?php

namespace App\Http\Controllers;

use App\GenFieldField;
use App\GenFieldGeneralSet;
use Illuminate\Http\Request;
use App\Report;


class PrintController extends Controller
{
    public function index(Request $request)
    {

        // 所見データ
        $array = $request->all();
        $items = json_decode($array["syoken"], true);
        $part = array();
        $comment = array();
        $action = array();


        foreach ($items as $item) {
            array_push($part, $item["part"]);
            array_push($comment, $item["comment"]);
            array_push($action, $item["action"]);
        }


        // ---------------------  修正　---------------------------------
        // 現場情報読込
        $genfield = GenFieldField::first();
        // var_dump($genfield['id']);
        // dd($genfield['field_name']);
        $general_set = GenFieldGeneralSet::first();
        // ---------------------------------------------------------------



        return view('print', [
            'part' => $part,
            'comment' => $comment,
            'action' => $action,
            'genfield' => $genfield,
            'general_set' => $general_set,
        ]);
    }


    public function save(Request $request)
    {
        $array = $request->all();
        $items = json_decode($array["saveData"], true);

        $part = array();
        $comment = array();
        $action = array();
        $genfield_id = array();

        foreach ($items as $item) {
            array_push($part, $item["part"]);
            array_push($comment, $item["comment"]);
            array_push($action, $item["action"]);
            array_push($genfield_id, $item["genfield_id"]);
        }

        // [report_id]の現在の最大値から新しい[report_id]を取得
        $reportID_NotNull = Report::whereNotNull('report_id')->get();
        $report_id = 1;
        if (count($reportID_NotNull) != 0) {
            $report_id = Report::all()->max('report_id') + 1;
        }

        for ($i = 0; $i < count($part); $i++) {
            $report = new Report();
            $report->part = $part[$i];
            $report->comment = $comment[$i];
            $report->action = $action[$i];
            $report->genfield_id = $genfield_id[$i];
            $report->report_id = $report_id;
            $report->save();
        }

        return view('print_save');
    }


    // 保存情報取得
    public function load(Request $request)
    {

        // 所見データ取得（更新日の新しい順）
        $syokenItems = Report::orderBy('created_at', 'desc')->get();

        // var_dump($syokenItems[0]->genfield->field_name);

        // ここから下はデータをreport_idでまとめた場合
        // --------------------------------------------------------
        $temp_reportID_set = Report::select('report_id')->distinct()->orderBy('report_id', 'desc')->get();
        $reportItem_set = [];
        foreach ($temp_reportID_set as $temp_reportID) {
            $report_set = Report::where('report_id', $temp_reportID->report_id)->first();

            $reportItem = array(
                'report_id' => $temp_reportID->report_id,
                // 'field_name' => '',
                'part' => $report_set->part,
                'comment' => $report_set->comment,
                'action' => $report_set->action,
                'created_at' => $report_set->created_at->format('Y/m/d H:i:s'),
            );
            $reportItem_set[] = $reportItem;
        }
        // ----------------------------------------------------------


        $reportItem_jsonset = json_encode($reportItem_set);
        // $reportItem_jsonset = json_encode(array('a' => 1, 'b' => 2));

        return view('print_load', [
            'syokenItems' => $syokenItems,
            'reportItem_jsonset' => $reportItem_jsonset,
        ]);
    }
}
