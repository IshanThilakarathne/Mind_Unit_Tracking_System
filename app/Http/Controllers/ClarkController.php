<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Notification;

class ClarkController extends Controller
{
    public function ClarkPageLoade(Request $request)
    {
        return view('Clark UI.clark');
    }

    public function NewSellerRegPgeLoad(Request $request)
    {
        return view('Clark UI.Clark Pages.sellerReg');
    }

    public function NewSellerReg(Request $request)
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
            $user->password = bcrypt("system@12345");
            $user->status = 'Active';
            $user->roll = 'Seller';
        }
        $user->save();
        return response()->json(['success' => "New Seller Registered Successfully"]);
    }

    public function NewPostRegPgeLoad(Request $request)
    {
        return view('Clark UI.Clark Pages.postReg');
    }

    public function SellerAllDataLoad(Request $request)
    {
        $data = User::select('id', 'nicno', 'fname', 'lname', 'MobileNo', 'email')
            ->where('status', '=', 'Active')
            ->where('roll', '=', 'Seller')
            ->get();
        return ($data);
    }

    public function Get_tble_click_Seller_user(Request $request)
    {
        $data = User::select('id', 'nicno', 'fname', 'lname', 'MobileNo', 'email')
            ->where('id', '=', $request->id)
            ->get();
        return ($data);
    }

    public function New_post_create(Request $request)
    {
        $user = new Post;
        $user->product_name = $request['input_product_name'];
        $user->seller_id = $request['input_seller_id'];
        $user->clark_id = $request['input_clark_id'];
        $user->receiver_f_name = $request['input_rece_f_name'];
        $user->receiver_l_name = $request['input_rece_l_name'];
        $user->receiver_phone_no = $request['input_rece_phone_no'];
        $user->receiver_address = $request['input_rece_address'];
        $user->bar_code_print = '0';
        $user->Package_Processing_Started = 'Pending';
        $user->Package_Being_Prepared = 'Pending';
        $user->Pickup_In_Progress = 'Pending';
        $user->Arrived_at_Our_Warehouse = 'Pending';
        $user->Shipped = 'Pending';
        $user->Out_For_Delivery = 'Pending';
        $user->Delivered = 'Pending';
        $user->save();

        $id = Post::select('id', 'product_name', 'seller_id', 'clark_id', 'receiver_f_name', 'receiver_l_name')
        ->get()->last()->id;
        
        $user = new Notification;
        $user->post_id = $id;
        $user->user_id = $request['input_clark_id'];
        $user->to_id = $request['input_seller_id'];
        $user->notification_type = "New Package Add";
        $user->notification = "New Package Registered";
        $user->status = '1';
        $user->date_time = date("Y-m-d H:i:s");
        $user->save();

        return response()->json(['success' => "New Post Reg Successfully"]);
    }

    public function LoadStatusUpPage(Request $request)
    {
        return view('Clark UI.Clark Pages.statusUpdate');
    }

    public function AllPendingdelivery(Request $request)
    {
        $data = Post::select('id', 'product_name', 'seller_id', 'clark_id', 'receiver_f_name', 'receiver_l_name')
            ->where('Delivered', '=', 'Pending')
            ->where('bar_code_print', '=', '1')
            ->get();
        return ($data);
    }

    public function LoadCurruntDeliveryStatus(Request $request)
    {
        $data = Post::select('id', 'seller_id', 'Package_Processing_Started', 'Package_Being_Prepared', 'Pickup_In_Progress', 'Arrived_at_Our_Warehouse', 'Shipped', 'Out_For_Delivery', 'Delivered')
            ->where('id', '=', $request->id)
            ->get();
        return ($data);
    }

    public function UpDate_Status(Request $request)
    {
        $action = $request->stage;
        if ($action) {
            if ($action == "stage1") {
                $user = Post::where('id', $request['id'])->first();
                if ($user) {
                    $user = Post::find($request['id']);
                    $user->Package_Processing_Started = 'Completed';
                    $user->Package_Processing_Started_d_t = date("Y-m-d H:i:s");
                    $user->save();

                    $user = new Notification;
                    $user->post_id = $request['id'];
                    $user->user_id = $request['user_id'];
                    $user->to_id = $request['seller_id'];
                    $user->notification_type = "Status Update";
                    $user->notification = "Package Processing Completed";
                    $user->status = '1';
                    $user->date_time = date("Y-m-d H:i:s");
                    $user->save();

                    return response()->json(['success' => "Status Update Successfully"]);
                } else {
                    return response()->json(['exists' => "Update Fail"]);
                }
            }
            if ($action == "stage2") {
                $user = Post::where('id', $request['id'])->first();
                if ($user) {
                    $user = Post::find($request['id']);
                    $user->Package_Being_Prepared = 'Completed';
                    $user->Package_Being_Prepared_d_t = date("Y-m-d H:i:s");
                    $user->save();

                    $user = new Notification;
                    $user->post_id = $request['id'];
                    $user->user_id = $request['user_id'];
                    $user->to_id = $request['seller_id'];
                    $user->notification_type = "Status Update";
                    $user->notification = "Package Being Prepare Completed";
                    $user->status = '1';
                    $user->date_time = date("Y-m-d H:i:s");
                    $user->save();

                    return response()->json(['success' => "Status Update Successfully"]);
                } else {
                    return response()->json(['exists' => "Update Fail"]);
                }
            }
            if ($action == "stage3") {
                $user = Post::where('id', $request['id'])->first();
                if ($user) {
                    $user = Post::find($request['id']);
                    $user->Pickup_In_Progress = 'Completed';
                    $user->Pickup_In_Progress_d_t = date("Y-m-d H:i:s");
                    $user->save();

                    $user = new Notification;
                    $user->post_id = $request['id'];
                    $user->user_id = $request['user_id'];
                    $user->to_id = $request['seller_id'];
                    $user->notification_type = "Status Update";
                    $user->notification = "Pickup In Progress Completed";
                    $user->status = '1';
                    $user->date_time = date("Y-m-d H:i:s");
                    $user->save();

                    return response()->json(['success' => "Status Update Successfully"]);
                } else {
                    return response()->json(['exists' => "Update Fail"]);
                }
            }
            if ($action == "stage4") {
                $user = Post::where('id', $request['id'])->first();
                if ($user) {
                    $user = Post::find($request['id']);
                    $user->Arrived_at_Our_Warehouse = 'Completed';
                    $user->Arrived_at_Our_Warehouse_d_t = date("Y-m-d H:i:s");
                    $user->save();

                    $user = new Notification;
                    $user->post_id = $request['id'];
                    $user->user_id = $request['user_id'];
                    $user->to_id = $request['seller_id'];
                    $user->notification_type = "Status Update";
                    $user->notification = "Arrived At Our Warehouse Completed";
                    $user->status = '1';
                    $user->date_time = date("Y-m-d H:i:s");
                    $user->save();

                    return response()->json(['success' => "Status Update Successfully"]);
                } else {
                    return response()->json(['exists' => "Update Fail"]);
                }
            }
            if ($action == "stage5") {
                $user = Post::where('id', $request['id'])->first();
                if ($user) {
                    $user = Post::find($request['id']);
                    $user->Shipped = 'Completed';
                    $user->Shipped_d_t = date("Y-m-d H:i:s");
                    $user->save();

                    $user = new Notification;
                    $user->post_id = $request['id'];
                    $user->user_id = $request['user_id'];
                    $user->to_id = $request['seller_id'];
                    $user->notification_type = "Status Update";
                    $user->notification = "Package has been Shipped";
                    $user->status = '1';
                    $user->date_time = date("Y-m-d H:i:s");
                    $user->save();

                    return response()->json(['success' => "Status Update Successfully"]);
                } else {
                    return response()->json(['exists' => "Update Fail"]);
                }
            }
            if ($action == "stage6") {
                $user = Post::where('id', $request['id'])->first();
                if ($user) {
                    $user = Post::find($request['id']);
                    $user->Out_For_Delivery = 'Completed';
                    $user->Out_For_Delivery_d_t = date("Y-m-d H:i:s");
                    $user->save();

                    $user = new Notification;
                    $user->post_id = $request['id'];
                    $user->user_id = $request['user_id'];
                    $user->to_id = $request['seller_id'];
                    $user->notification_type = "Status Update";
                    $user->notification = "Out For Delivery Completed";
                    $user->status = '1';
                    $user->date_time = date("Y-m-d H:i:s");
                    $user->save();

                    return response()->json(['success' => "Status Update Successfully"]);
                } else {
                    return response()->json(['exists' => "Update Fail"]);
                }
            }
            if ($action == "stage7") {
                $user = Post::where('id', $request['id'])->first();
                if ($user) {
                    $user = Post::find($request['id']);
                    $user->Delivered = 'Completed';
                    $user->Delivered_d_t = date("Y-m-d H:i:s");
                    $user->save();

                    $user = new Notification;
                    $user->post_id = $request['id'];
                    $user->user_id = $request['user_id'];
                    $user->to_id = $request['seller_id'];
                    $user->notification_type = "Status Update";
                    $user->notification = "Package has been Delivered";
                    $user->status = '1';
                    $user->date_time = date("Y-m-d H:i:s");
                    $user->save();

                    return response()->json(['success' => "Status Update Successfully"]);
                } else {
                    return response()->json(['exists' => "Update Fail"]);
                }
            }
        }
        return response()->json(['exists' => "Update Fail......"]);
    }

    public function BarCodePrintPgLoad(Request $request)
    {
        return view('Clark UI.Clark Pages.barcodePrint');
    }

    public function AllPendingPrint(Request $request)
    {
        $data = Post::select('id', 'product_name', 'seller_id', 'clark_id', 'receiver_f_name', 'receiver_l_name')
            ->where('Delivered', '=', 'Pending')
            ->where('bar_code_print', '=', '0')
            ->get();
        return ($data);
    }

    public function SelectPendingPrint(Request $request)
    {
        $data = Post::select('posts.id', 'posts.seller_id', 'posts.receiver_f_name', 'posts.receiver_l_name', 'posts.receiver_phone_no', 'posts.receiver_address', 'users.fname', 'users.lname', 'users.email', 'users.address')
            ->join('users', 'posts.seller_id', '=', 'users.id')
            ->where('posts.id', '=', $request->id)
            ->get();
        return ($data);
    }

    public function printStatusaUpDate(Request $request)
    {
        $data = Post::where('id', $request['id'])->first();
        if ($data) {
            $data = Post::find($request['id']);
            $data->bar_code_print = '1';
            $data->save();
            return response()->json(['success' => "Notifications Mark Successfully"]);
        }
    }

    public function LoadClarkProfilePg(Request $request)
    {
        return view('Clark UI.Clark Pages.myprofile');
    }

    public function LoadSClarkFrofile(Request $request)
    {
        $data = User::select('id', 'nicno', 'fname', 'lname', 'MobileNo', 'email', 'address', 'password')
            ->where('id', '=', $request->User_id)
            ->get();
        return ($data);
    }

    public function UpDateClarkFrofile(Request $request)
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

    public function UpDateClarkPWUpdate(Request $request)
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
