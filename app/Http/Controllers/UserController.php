<?php

namespace App\Http\Controllers;

use App\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function index()
    {
       $user =  UserModel::get();
       return $user;
    }
}
