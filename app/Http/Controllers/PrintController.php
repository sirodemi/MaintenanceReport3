<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;

class PrintController extends Controller
{
    public function index(Request $request)
    {

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

        return view('print', [
            'part' => $part,
            'comment' => $comment,
            'action' => $action,
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
