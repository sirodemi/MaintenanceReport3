<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cause;
use Validator;

class CauseController extends Controller
{
    public function index(Request $request)
    {
        $items_cause = Cause::all();

        return view(
            'cause',
            [
                'items_cause' => $items_cause,
            ]
        );
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cause' => 'required',
        ]);

        $cause_inst = new cause();
        $cause_inst->cause = $request->cause;
        $cause_inst->save();

        return redirect('cause');
    }


    public function delete(cause $cause)
    {
        $cause->delete();
        return redirect('cause');
    }

    public function edit(cause $cause)
    {
        //{books}id値を取得 => Book $books id値の１レコード取得  });
        return view('cause_edit', ['cause' => $cause]);
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cause' => 'required',
        ]);

        //データ更新
        $cause_find = Cause::find($request->id);
        $cause_find->cause = $request->cause;
        $cause_find->save();

        return redirect('cause');
    }
}
