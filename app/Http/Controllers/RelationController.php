<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relation;
use App\Syoken;
use Validator;

class RelationController extends Controller
{
    public function index(Request $request)
    {
        $items_relation = Relation::all();

        return view(
            'relation',
            [
                'items_relation' => $items_relation,
            ]
        );
    }


    // 新規登録
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required',
        ]);

        $relation_inst = new relation();
        $relation_inst->comment = $request->comment;
        $relation_inst->syojo   = $request->syojo;
        $relation_inst->part    = $request->part;
        $relation_inst->cause   = $request->cause;
        $relation_inst->save();

        return redirect('relation');
    }


    public function delete(Relation $relation)
    {
        $relation->delete();
        return redirect('relation');
    }

    public function edit(Relation $relation)
    {
        //id値を取得 => １レコード取得
        return view('relation_edit', ['comment' => $relation]);
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required',
        ]);

        //データ更新
        $relation_find = Relation::find($request->id);
        $relation_find->comment = $request->comment;
        $relation_find->syojo   = $request->syojo;
        $relation_find->part    = $request->part;
        $relation_find->cause   = $request->cause;
        $relation_find->save();

        return redirect('relation');
    }
}
