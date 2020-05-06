<?php

namespace App\Http\Controllers;

use App\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    function index()
    {
        return view('home.main');
    }
    function addProduct(REQUEST $request)
    {
        $datasToAdd = Validator::make(
            $request->input(),
            [
                "name" => "required",
                "prix"=>"required",
                "id_producer"=>"required",
            ],
            [
                'required' => 'Le champ :attribute est requis'
            ]
        )->validate();

        $addToDb = ProductModel::create($datasToAdd);
        return $addToDb;
    }
}
