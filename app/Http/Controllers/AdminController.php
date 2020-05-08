<?php

namespace App\Http\Controllers;

use App\Http\Resources\addProductResource;
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
    function addProduct(Request $request)
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
        
        $product = ProductModel::find(1);
        $product->fruits()->attach();
        $addToDb = ProductModel::create($datasToAdd);
        return new addProductResource($addToDb);
    
    }
}
