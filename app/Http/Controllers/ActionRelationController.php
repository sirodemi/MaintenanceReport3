<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActionRelation;
use Validator;

class ActionRelationController extends Controller
{
    public function index(Request $request)
    {
        $items_actionRelation = ActionRelation::all();

        return view(
            'actionRelation',
            [
                'items_actionRelation' => $items_actionRelation,
            ]
        );
    }
}
