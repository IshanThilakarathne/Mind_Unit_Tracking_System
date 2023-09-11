<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function creatNew_user(Request $request)
    {

        $user = User::where('nicno', $request['input_nicno'])->first();

        if ($user) {
            return response()->json(['exists' => "ID Number alredy exists"]);
        } else {
            $user = new User;
            $user->nicno = $request['input_nicno'];
            $user->fname = $request['input_fname'];
            $user->lname = $request['input_lname'];
            $user->MobileNo = $request['input_phone_no'];
            $user->email = $request['input_email'];
            $user->address = $request['input_addree'];
            $user->password = bcrypt('system@12345');
            $user->status = $request['input_stasus'];
            $user->roll = $request['input_roll'];
        }
        $user->save();
        return response()->json(['success' => "New User Registered Successfully"]);
    }
}
