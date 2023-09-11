<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function loginPageLoade(Request $request)
    {
        return view('Login UI.login_pge');
    }

    public function userLogin(Request $request)
    {
        if (Auth::attempt([
            'nicno' => $request->input('l_id_card_no'),
            'password' => $request->input('l_password'),
            'status' => "Active"
        ])) {

            $data = User::select('roll')
                ->where('nicno', '=', $request->l_id_card_no)
                ->get();  
            if ($data) {

                $roll = json_decode($data[0]);
                return response()->json(['success' => 'Successfully Logged In', $roll, 'activetion' => 'Activeted']);
            }

            return response()->json(['success' => 'Successfully Logged In', 'roll' => 'Roll Not Found']);
        } else {

            $status = User::where('nicno', $request->input('l_id_card_no') && 'status', 'Active')->get();

            $status = User::select('status')
                ->where('nicno', '=', $request->l_id_card_no)
                ->get();

            if ($status[0]['status'] == "Active") {
                return response()->json(['error' => 'Id number or password increct. Please try agein...!']);
            } else {
                return response()->json(['activetion' => 'Deactiveted']);
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
