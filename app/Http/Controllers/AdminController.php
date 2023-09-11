<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use App\Models\Post;


class AdminController extends Controller
{
    public function adminPageLoade(Request $request)
    {
        return view('Admin UI.admin');
    }

    public function loadAllUsersPage(Request $request)
    {
        return view('Admin UI.Admin Pages.allusers');
    }

    public function loadAllUsData(Request $request)
    {
        $data = User::select('id', 'nicno', 'fname', 'MobileNo', 'status', 'roll',)->get();
        return ($data);
    }

    public function GetMoreData(Request $request)
    {
        $data = User::select('lname', 'email', 'address', 'password', 'roll', 'created_at', 'updated_at')
            ->where('id', '=', $request->id)
            ->get();
        return ($data);
    }

    public function Get_tbl_click_user(Request $request)
    {
        $data = User::select('id', 'nicno', 'fname', 'lname', 'MobileNo', 'email', 'address', 'status', 'roll')
            ->where('id', '=', $request->id)
            ->get();
        return ($data);
    }

    public function Uase_data_up(Request $request)
    {
        $user = User::where('id', $request['input_user_id'])->first();
        if ($user) {
            $user = User::find($request['input_user_id']);
            $user->fname = $request['input_fname'];
            $user->lname = $request['input_lname'];
            $user->MobileNo = $request['input_phone_no'];
            $user->email = $request['input_email'];
            $user->address = $request['input_addree'];
            $user->status = $request['input_stasus'];
            $user->roll = $request['input_roll'];
            $user->save();
            return response()->json(['success' => "User Registered Successfully"]);
        } else {
            return response()->json(['exists' => "Update Fail"]);
        }
    }

    public function DeleteUsers(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user) {
            $user = User::find($request->id);
            $user->delete();
            return response()->json(['success' => "User Delete Successfully"]);
        } else {
            return response()->json(['exists' => "User Delete Update Fail"]);
        }
    }

    public function GetAdminUnreadMsgCount(Request $request)
    {
        $data = Notification::where('notification_type', '=', 'complaint to admin')
            ->where('status', '=', '1')
            ->count();
        return ($data);
    }

    public function GetAdminUnreadMsg(Request $request)
    {
        $data = Notification::select('id', 'post_id', 'user_id', 'notification', 'date_time')
            ->where('notification_type', '=', 'complaint to admin')
            ->where('status', '=', '1')
            ->limit(5)
            ->get();
        return ($data);
    }

    public function GetAdminClickUnreadMsg(Request $request)
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

    public function LoadAllAdmimMsg(Request $request)
    {
        $data = Notification::select('id', 'post_id', 'user_id', 'notification', 'date_time')
            ->where('notification_type', '=', 'complaint to admin')
            ->get();
        return ($data);
    }

    public function LoadAllmsgAdmin(Request $request)
    {
        return view('Admin UI.Admin Pages.allAdminMsg');
    }

    public function DeleteThisAdminMsg(Request $request)
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

    public function Get_Status(Request $request)
    {
        $data = Post::select('id', 'product_name', 'seller_id', 'clark_id', 'receiver_f_name', 'receiver_l_name', 'receiver_phone_no', 'receiver_address', 'Package_Processing_Started', 'Package_Processing_Started_d_t', 'Package_Being_Prepared', 'Package_Being_Prepared_d_t', 'Pickup_In_Progress', 'Pickup_In_Progress_d_t', 'Arrived_at_Our_Warehouse', 'Arrived_at_Our_Warehouse_d_t', 'Shipped', 'Shipped_d_t', 'Out_For_Delivery', 'Out_For_Delivery_d_t', 'Delivered', 'Delivered_d_t')
            ->where('id', '=', $request->id)
            ->get();
        return ($data);
    }

    public function GLoadAllPost(Request $request)
    {
        return view('Admin UI.Admin Pages.allpost');
    }

    public function loadAllPostData(Request $request)
    {
        $data = Post::select('id', 'product_name', 'seller_id', 'receiver_f_name', 'receiver_l_name', 'Delivered',)->get();
        return ($data);
    }

    public function Get_tbl_click_post(Request $request)
    {
        $data = Post::select('id', 'product_name', 'receiver_f_name', 'receiver_l_name', 'receiver_phone_no', 'receiver_address', 'bar_code_print', 'Package_Processing_Started', 'Package_Being_Prepared', 'Pickup_In_Progress', 'Arrived_at_Our_Warehouse', 'Shipped', 'Out_For_Delivery', 'Delivered')
            ->where('id', '=', $request->id)
            ->get();
        return ($data);
    }

    public function Post_data_up(Request $request)
    {
        $post = Post::where('id', $request['post_id'])->first();
        if ($post) {
            $post = Post::find($request['post_id']);
            $post->product_name = $request['product_name'];
            $post->receiver_f_name = $request['receiver_f_name'];
            $post->receiver_l_name = $request['receiver_l_name'];
            $post->receiver_phone_no = $request['receiver_phone_no'];
            $post->receiver_address = $request['receiver_address'];
            $post->bar_code_print = $request['bar_code_print'];
            $post->Package_Processing_Started = $request['Package_Processing_Started'];
            $post->Package_Being_Prepared = $request['Package_Being_Prepared'];
            $post->Pickup_In_Progress = $request['Pickup_In_Progress'];
            $post->Arrived_at_Our_Warehouse = $request['Arrived_at_Our_Warehouse'];
            $post->Shipped = $request['Shipped'];
            $post->Out_For_Delivery = $request['Out_For_Delivery'];
            $post->Delivered = $request['Delivered'];
            $post->save();
            return response()->json(['success' => "Post Registered Successfully"]);
        } else {
            return response()->json(['exists' => "Update Fail"]);
        }
    }

    public function DeletePost(Request $request)
    {
        $user = Post::where('id', $request->id)->first();
        if ($user) {
            $user = Post::find($request->id);
            $user->delete();
            return response()->json(['success' => "User Delete Successfully"]);
        } else {
            return response()->json(['exists' => "User Delete Update Fail"]);
        }
    }

    public function LoadAdminProfilePg(Request $request)
    {
        return view('Admin UI.Admin Pages.myprofile');
    }

    public function LoadAdminFrofile(Request $request)
    {
        $data = User::select('id', 'nicno', 'fname', 'lname', 'MobileNo', 'email', 'address', 'password')
            ->where('id', '=', $request->User_id)
            ->get();
        return ($data);
    }

    public function UpDateAdminFrofile(Request $request)
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

    public function UpDateAdminPWUpdate(Request $request)
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
