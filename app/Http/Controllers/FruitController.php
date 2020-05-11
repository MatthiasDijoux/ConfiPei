<?php

namespace App\Http\Controllers;

use App\FruitModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FruitController extends Controller
{
    //
    function index(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $users = FruitModel::where('name', 'like', '%' . $query . '%')->get();
            return response()->json($users);
        }
    }
}
