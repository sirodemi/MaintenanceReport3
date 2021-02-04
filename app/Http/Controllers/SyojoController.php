<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Syojo;
use Validator;

class SyojoController extends Controller
{
    public function index(Request $request)
    {
        $items_syojo = Syojo::all();

        return view(
            'syojo',
            [
                'items_syojo' => $items_syojo,
            ]
        );
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'syojo' => 'required',
        ]);

        $syojo_inst = new Syojo();
        $syojo_inst->syojo = $request->syojo;
        $syojo_inst->save();

        return redirect('syojo');
    }


    public function delete(Syojo $syojo)
    {
        $syojo->delete();
        return redirect('syojo');
    }

    public function edit(Syojo $syojo)
    {
        //{books}id値を取得 => Book $books id値の１レコード取得  });
        return view('syojo_edit', ['syojo' => $syojo]);
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'syojo' => 'required',
        ]);

        //データ更新
        $syojo_find = Syojo::find($request->id);
        $syojo_find->syojo = $request->syojo;
        $syojo_find->save();

        return redirect('syojo');
    }
}
