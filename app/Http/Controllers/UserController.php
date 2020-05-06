<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\ProductModel;

class UserController extends Controller
{
    //
    function index()
    {
       $products =  ProductModel::with([
           'producers',
           'rewards',
           'fruits', 
       ])->get();
       return  ProductResource::collection($products);
    }
}
