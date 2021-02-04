<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Part;
use Validator;

class PartController extends Controller
{
    public function index(Request $request)
    {
        $items_part = Part::all();

        return view(
            'part',
            [
                'items_part' => $items_part,
            ]
        );
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'part' => 'required',
        ]);

        $part_inst = new Part();
        $part_inst->part = $request->part;
        $part_inst->save();

        return redirect('part');
    }


    public function delete(Part $part)
    {
        $part->delete();
        return redirect('part');
    }

    public function edit(Part $part)
    {
        //id値を取得 => id値の１レコード取得
        return view('part_edit', ['part' => $part]);
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'part' => 'required',
        ]);

        //データ更新
        $part_find = Part::find($request->id);
        $part_find->part = $request->part;
        $part_find->save();

        return redirect('part');
    }
}
