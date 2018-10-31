<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 31.10.18
 * Time: 2:12
 */

namespace App\Http\Controllers\Api;


use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;


class UserController
{
    public function usersList(Request $request){
        $users = User::query()->get();
        return UserResource::collection($users);
    }
}