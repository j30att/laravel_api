<?php
/**
 * Created by PhpStorm.
 * User: elf
 * Date: 20.09.2018
 * Time: 17:43
 */

namespace App\Http\Controllers;



use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController
{
    public function showProfile(){
        $user = Auth::user();
        return view('login.userproftest', compact('user'));
    }

    public function  editProfile(Request $request){

        $data = $request->all();

        $user = User::query()->where('id', $data['id'])->first();

        $user->name = $data['name'];
        $user->age = $data['age'];
        $user->save();



    }

}
