<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Notification;
use App\Models\User;

class SellerController extends Controller
{
    public function sellersPageLoade(Request $request)
    {
        return view('Seller UI.seller');
    }

    public function AllStatus_View(Request $request)
    {
        return view('Seller UI.Seller Pages.viewStatus');
    }

    public function LoadAllPostStatus(Request $request)
    {
        $data = Post::select('id', 'product_name', 'clark_id', 'receiver_f_name', 'receiver_l_name', 'receiver_phone_no', 'Delivered')
            ->where('seller_id', '=', $request->id)
            ->get();
        return ($data);
    }

    public function tblClickToGetMoreStatusData(Request $request)
    {
        $data = Post::select('id', 'product_name', 'seller_id', 'clark_id', 'receiver_f_name', 'receiver_l_name', 'receiver_phone_no', 'receiver_address', 'Package_Processing_Started', 'Package_Processing_Started_d_t', 'Package_Being_Prepared', 'Package_Being_Prepared_d_t', 'Pickup_In_Progress', 'Pickup_In_Progress_d_t', 'Arrived_at_Our_Warehouse', 'Arrived_at_Our_Warehouse_d_t', 'Shipped', 'Shipped_d_t', 'Out_For_Delivery', 'Out_For_Delivery_d_t', 'Delivered', 'Delivered_d_t')
            ->where('id', '=', $request->id)
            ->get();
        return ($data);
    }

    public function SentSellercomplaint(Request $request)
    {

        $user = new Notification;
        $user->post_id = $request['input_post_id'];
        $user->user_id = $request['input_seller_id'];
        $user->notification_type = "complaint to admin";
        $user->notification = $request['input_msg'];
        $user->status = '1';
        $user->date_time = date("Y-m-d H:i:s");

        $user->save();
        return response()->json(['success' => "Your Complaint send Successfully"]);
    }

    public function GetSellerUnreadMsgCount(Request $request)
    {

        $data = Notification::where('status', '=', '1')
            ->where('to_id', '=', $request->user_id)
            ->count();

        return ($data);
    }

    public function GetSellerUnreadMsg(Request $request)
    {

        $data = Notification::select('id', 'post_id', 'user_id', 'notification', 'date_time')
            ->where('status', '=', '1')
            ->where('to_id', '=', $request->user_id)
            ->limit(5)
            ->get();
        return ($data);
    }

    public function GetSellerClickUnreadMsg(Request $request)
    {

        $data = Notification::select('id', 'post_id', 'user_id', 'notification', 'date_time')
            ->where('id', '=', $request->id)
            ->get();

        return ($data);
    }

    public function MarkAsMsgRead(Request $request)
    {
        $data = Notification::where('id', $request['id'])->first();

        if ($data) {

            $data = Notification::find($request['id']);

            $data->status = '0';
            $data->save();

            return response()->json(['success' => "Notifications Mark Successfully"]);
        }
    }

    public function Get_Status(Request $request)
    {
        $data = Post::select('id', 'product_name', 'seller_id', 'clark_id', 'receiver_f_name', 'receiver_l_name', 'receiver_phone_no', 'receiver_address', 'Package_Processing_Started', 'Package_Processing_Started_d_t', 'Package_Being_Prepared', 'Package_Being_Prepared_d_t', 'Pickup_In_Progress', 'Pickup_In_Progress_d_t', 'Arrived_at_Our_Warehouse', 'Arrived_at_Our_Warehouse_d_t', 'Shipped', 'Shipped_d_t', 'Out_For_Delivery', 'Out_For_Delivery_d_t', 'Delivered', 'Delivered_d_t')
            ->where('id', '=', $request->id)
            ->get();
        return ($data);
    }

    public function AllNotification(Request $request)
    {
        return view('Seller UI.Seller Pages.allmsg');
    }

    public function LoadAllSellerMsg(Request $request)
    {
        $data = Notification::select('id', 'post_id', 'user_id', 'notification', 'date_time')
            ->where('to_id', '=', $request->user_id)
            ->get();
        return ($data);
    }

    public function DeleteThisSellerMsg(Request $request)
    {
        $data = Notification::where('id', $request->id)->first();
        if ($data) {

            $data = Notification::find($request->id);
            $data->delete();

            return response()->json(['success' => "Notifications Delete Successfully"]);
        } else {
            return response()->json(['exists' => "Notifications Delete Fail"]);
        }
    }

    public function LoadSellerProfilePg(Request $request)
    {
        return view('Seller UI.Seller Pages.myprofile');
    }

    public function LoadSellerFrofile(Request $request)
    {
        $data = User::select('id', 'nicno', 'fname', 'lname', 'MobileNo', 'email', 'address', 'password')
            ->where('id', '=', $request->User_id)
            ->get();
        return ($data);
    }

    public function UpDateSellerFrofile(Request $request)
    {
        $user = User::where('id', $request['user_id'])->first();

        if ($user) {

            $user = User::find($request['user_id']);

            $user->fname = $request['input_fname'];
            $user->lname = $request['input_lname'];
            $user->MobileNo = $request['input_phone_no'];
            $user->email = $request['input_email'];
            $user->address = $request['input_addree'];
            $user->save();

            return response()->json(['success' => "Admin Profile Update Successfully"]);
        } else {
            return response()->json(['exists' => "Admin Profile Update Update Fail"]);
        }
    }

    public function UpDateSellerPWUpdate(Request $request)
    {
        $user = User::where('id', $request['user_id_forpw'])->first();

        if ($user) {

            $user = User::find($request['user_id_forpw']);

            $user->password = bcrypt($request['input_password']);
            $user->save();

            return response()->json(['success' => "User Registered Successfully"]);
        } else {
            return response()->json(['exists' => "Update Fail"]);
        }
    }
}
