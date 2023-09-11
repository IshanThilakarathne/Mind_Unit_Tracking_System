<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Notification;

class HomePageController extends Controller
{
    public function Load_homePge(Request $request)
    {
        // Auth::logout();
        return view('Home Master UI.homepage');
        // return redirect('/');
    }

    public function CheckStatus_now(Request $request)
    {

        $user = Post::where('id', $request['id'])->first();

        if ($user) {
            $data = Post::select('id', 'product_name', 'seller_id', 'receiver_f_name', 'receiver_l_name', 'Package_Processing_Started', 'Package_Processing_Started_d_t', 'Package_Being_Prepared', 'Package_Being_Prepared_d_t', 'Pickup_In_Progress', 'Pickup_In_Progress_d_t', 'Arrived_at_Our_Warehouse', 'Arrived_at_Our_Warehouse_d_t', 'Shipped', 'Shipped_d_t', 'Out_For_Delivery', 'Out_For_Delivery_d_t', 'Delivered', 'Delivered_d_t')
                ->where('id', '=', $request->id)
                ->get();
            return ($data);
        } else {
            return response()->json(['error' => "No Data"]);
        }
    }

    public function SentCustomercomplaint(Request $request)
    {

        $user = new Notification;
        $user->post_id = $request['input_post_id'];
        $user->user_id = $request['input_seller_id'];
        $user->notification_type = "complaint to seller";
        $user->notification = $request['input_msg'];
        $user->status = '1';
        $user->to_id = $request['input_seller_id'];
        $user->date_time = date("Y-m-d H:i:s");

        $user->save();
        return response()->json(['success' => "Your Complaint send Successfully"]);
    }
}
