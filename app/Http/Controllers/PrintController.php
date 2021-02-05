<?php

namespace App\Http\Controllers;

use App\GenFieldField;
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



        // 現場情報読込
        $genfield = GenFieldField::first();
        // dd($genfield['field_name']);


        return view('print', [
            'part' => $part,
            'comment' => $comment,
            'action' => $action,
            'genfield' => $genfield,
        ]);
    }

    public function save(Request $request)
    {
        $array = $request->all();
        $items = json_decode($array["saveData"], true);

        $part = array();
        $comment = array();
        $action = array();

        foreach ($items as $item) {
            array_push($part, $item["part"]);
            array_push($comment, $item["comment"]);
            array_push($action, $item["action"]);
        }

        for ($i = 0; $i < count($part); $i++) {
            $report = new Report();
            $report->part = $part[$i];
            $report->comment = $comment[$i];
            $report->action = $action[$i];
            $report->save();
        }
        return view('print_save');
    }
}
