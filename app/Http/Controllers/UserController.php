<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Resources\UsersResource;
use App\ProductModel;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function index(Request $request)
    {
        /*   $products =  ProductModel::with([
           'producers',
           'rewards',
           'fruits', 
       ])->get();
       return  ProductResource::collection($products); */
        $user = $request->user();
        $currentUser = User::find($user->id);
        return new UsersResource($currentUser);
    }
}
