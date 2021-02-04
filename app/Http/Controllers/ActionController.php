<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;
use Validator;

class ActionController extends Controller
{
    public function index(Request $request)
    {
        $items_action = Action::all();

        return view(
            'action',
            [
                'items_action' => $items_action,
            ]
        );
    }


    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action' => 'required',
        ]);

        $action_inst = new Action();
        $action_inst->action = $request->action;
        $action_inst->save();

        return redirect('action');
    }


    public function delete(Action $action)
    {
        $action->delete();
        return redirect('action');
    }

    public function edit(Action $action)
    {
        //id値を取得 => id値の１レコード取得
        return view('action_edit', ['action' => $action]);
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action' => 'required',
        ]);

        //データ更新
        $action_find = Action::find($request->id);
        $action_find->action = $request->action;
        $action_find->save();

        return redirect('action');
    }
}
