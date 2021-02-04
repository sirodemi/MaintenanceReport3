<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Syojo;
use App\Part;
use App\Cause;
use App\Comment;
use App\Report;
use App\Action;
use App\ActionRelation;
use Validator;

class SyokenController extends Controller
{
    public function index(Request $request)
    {

        $items_syojo    = Syojo::all();
        $items_part     = Part::all();
        $items_cause    = Cause::all();
        $items_comment  = Comment::all();
        $items_action   = Action::all();
        $items_actionRelation   = ActionRelation::all();

        return view(
            'syoken',
            [
                'items_syojo'   => $items_syojo,
                'items_part'    => $items_part,
                'items_cause'   => $items_cause,
                'items_comment' => $items_comment,
                'items_action'  => $items_action,
                'items_actionRelation'  => $items_actionRelation,
            ]
        );
    }

    public function syoken_save(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'comment_id' => 'required',
        ]);


        foreach ($request->comment_id as $comment_id) {
            $report = new Report();
            $report->comment_id = $comment_id;
            $report->save();
        }

        return redirect('syoken');
    }
}
