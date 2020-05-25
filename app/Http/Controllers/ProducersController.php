<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsersResource;
use App\User;
class ProducersController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        return new UsersResource($user);
    }
}
