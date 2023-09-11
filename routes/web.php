<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home page Load
Route::get('/','App\Http\Controllers\HomePageController@Load_homePge');

// Check Trackin Status  ----> Home Page
Route::post('check_status','App\Http\Controllers\HomePageController@CheckStatus_now');

// Complant to seller  ----> Home Page
Route::post('complaintNow_to_seller','App\Http\Controllers\HomePageController@SentCustomercomplaint');

// User Login Page Load
Route::get('loginReg','App\Http\Controllers\LoginController@loginPageLoade')->name('loginReg');

// User Login
Route::post('user_login','App\Http\Controllers\LoginController@userLogin');


Route::group(['middleware' => 'auth.user'], function(){

    // User Logout
    Route::get('logout','App\Http\Controllers\LoginController@logout')->name('logout');

    // Load Admin Page ----->Admin Page
    Route::get('admin','App\Http\Controllers\AdminController@adminPageLoade')->name('admin');

    // Load All User data for Admin Page ----->Admin Page
    Route::get('getallusers','App\Http\Controllers\AdminController@loadAllUsersPage');

    // Load All User Data For Admin Panel ----->Admin Page
    Route::post('load_All_Users','App\Http\Controllers\AdminController@loadAllUsData');

    // New User Reg ----->Admin Page
    Route::post('New_user_reg','App\Http\Controllers\UserController@creatNew_user');

    // View More User Data ----->Admin Page
    Route::post('View_more','App\Http\Controllers\AdminController@GetMoreData');

    // View More Selected User Data  ----->Admin Page
    Route::post('tbl_click_to_data','App\Http\Controllers\AdminController@Get_tbl_click_user');

    // Update user data ----->Admin Page
    Route::post('User_update','App\Http\Controllers\AdminController@Uase_data_up');

    // delete user data ----->Admin Page
    Route::post('User_delete','App\Http\Controllers\AdminController@DeleteUsers');

    // Get Admin All Unread Msg Count ----->Admin Page
    Route::post('all_unread_msg_counts','App\Http\Controllers\AdminController@GetAdminUnreadMsgCount');

    // Get Admin All Unread Msg ----->Admin Page
    Route::post('all_unread_msg','App\Http\Controllers\AdminController@GetAdminUnreadMsg');

    // Get Admin click Unread Msg ----->Admin Page
    Route::post('view_new_msg_by_admin','App\Http\Controllers\AdminController@GetAdminClickUnreadMsg');

    // Mark Read Msg ----->Admin Page
    Route::post('markMsReadAdmin','App\Http\Controllers\AdminController@MarkAsMsgRead');

    // Get all admin msg ----->Admin Page
    Route::post('gelAllAdminMsg','App\Http\Controllers\AdminController@LoadAllAdmimMsg');

    // Load All admin Msg page ----->Admin Page
    Route::get('getAdminMsgPge','App\Http\Controllers\AdminController@LoadAllmsgAdmin');

    // Delete this admin Msg  ----->Admin Page
    Route::post('delete_admin_msg','App\Http\Controllers\AdminController@DeleteThisAdminMsg');

    // View Statu usin Notificatin admin Msg  ----->Admin Page
    Route::post('ViewStatusUsingNotifMsg','App\Http\Controllers\AdminController@Get_Status');

    // View All Post Pag Load admin Msg  ----->Admin Page
    Route::get('viewAllPost','App\Http\Controllers\AdminController@GLoadAllPost');

    // Load All Post Data For Admin Panel ----->Admin Page
    Route::post('load_All_Post','App\Http\Controllers\AdminController@loadAllPostData');

    // View More Selected Post Data  ----->Admin Page
    Route::post('tbl_click_to_post','App\Http\Controllers\AdminController@Get_tbl_click_post');

    // Update post data ----->Admin Page
    Route::post('Post_update','App\Http\Controllers\AdminController@Post_data_up');

    // delete post data ----->Admin Page
    Route::post('Post_delete','App\Http\Controllers\AdminController@DeletePost');

    // View profile Pag Load admin Msg  ----->Admin Page
    Route::get('viewMyProfileAd','App\Http\Controllers\AdminController@LoadAdminProfilePg');

    // Load admin profile data ----->Admin Page
    Route::post('load_MyProFile','App\Http\Controllers\AdminController@LoadAdminFrofile');

    // update admin profile data ----->Admin Page
    Route::post('updateAdminProfile','App\Http\Controllers\AdminController@UpDateAdminFrofile');

    // update admin password data ----->Admin Page
    Route::post('updateAdminPw','App\Http\Controllers\AdminController@UpDateAdminPWUpdate');








    // Load Clark Page
    Route::get('clarkpg','App\Http\Controllers\ClarkController@ClarkPageLoade')->name('clarkpg');

    // Reg New Seller Load -->  Clark Page
    Route::get('regNewSeller','App\Http\Controllers\ClarkController@NewSellerRegPgeLoad');

    // New seller reg --> Clark Page
    Route::post('New_seller_reg','App\Http\Controllers\ClarkController@NewSellerReg');

    // Reg New Post Page Load --> Clark Page
    Route::get('regNewPost','App\Http\Controllers\ClarkController@NewPostRegPgeLoad');

    // Load All seller --> Clark Page
    Route::post('load_All_Sellers','App\Http\Controllers\ClarkController@SellerAllDataLoad');

    // Load Seller Data to View Form --> Clark Page
    Route::post('tbl_click_to_seller_data','App\Http\Controllers\ClarkController@Get_tble_click_Seller_user');

    // Add New Post --> Clark Page
    Route::post('AddNewPost','App\Http\Controllers\ClarkController@New_post_create');

    // Status Update Page Load --> Clark Page
    Route::get('statusUpdatePge','App\Http\Controllers\ClarkController@LoadStatusUpPage');

    // Load all pending Dilivery Post --> Clark Page
    Route::post('load_All_pending_delivery','App\Http\Controllers\ClarkController@AllPendingdelivery');

    // Get Uurrunt Post Status --> Clark Page
    Route::post('Get_Currunt_Status','App\Http\Controllers\ClarkController@LoadCurruntDeliveryStatus');

    // Update Status --> Clark Page
    Route::post('statusaUpdateNow','App\Http\Controllers\ClarkController@UpDate_Status');

    // Barcode Print Page Load --> Clark Page
    Route::get('barcodePrintPg','App\Http\Controllers\ClarkController@BarCodePrintPgLoad');

    // Load all pending print barcode --> Clark Page
    Route::post('load_All_Print_pending','App\Http\Controllers\ClarkController@AllPendingPrint');

    // Load selected pending print barcode --> Clark Page
    Route::post('Get_Currunt_Print_data','App\Http\Controllers\ClarkController@SelectPendingPrint');

    // print status --> Clark Page
    Route::post('print_satatusUpdate','App\Http\Controllers\ClarkController@printStatusaUpDate');

    // View profile Pag Load Clark Msg  ----->Clark Page
    Route::get('viewMyProfileClark','App\Http\Controllers\ClarkController@LoadClarkProfilePg');

    // Load Clark profile data ----->Clark Page
    Route::post('load_ClarkProFile','App\Http\Controllers\ClarkController@LoadSClarkFrofile');

    // update Clark profile data ----->Clark Page
    Route::post('updateClarkProfile','App\Http\Controllers\ClarkController@UpDateClarkFrofile');

    // update Clark password data ----->Clark Page
    Route::post('updateClarkPw','App\Http\Controllers\ClarkController@UpDateClarkPWUpdate');






    // Load Seller Page ---> Seller Page
    Route::get('Sellerpg','App\Http\Controllers\SellerController@sellersPageLoade')->name('Sellerpg');

    // Load Status View Page ---> Seller Page
    Route::get('viewStatus','App\Http\Controllers\SellerController@AllStatus_View');

    // View all Status --> Seller Page
    Route::post('load_All_Post_Status','App\Http\Controllers\SellerController@LoadAllPostStatus');

    // Get More Data Status --> Seller Page
    Route::post('tbl_click_to_Get_More','App\Http\Controllers\SellerController@tblClickToGetMoreStatusData');

    // Sent Complain to admin --> Seller Page 
    Route::post('complaintNow','App\Http\Controllers\SellerController@SentSellercomplaint');

    // Get unread msg count --> Seller Page 
    Route::post('all_unread_msg_countsSeller','App\Http\Controllers\SellerController@GetSellerUnreadMsgCount');

    // Get unread msg --> Seller Page 
    Route::post('all_unread_msgSeller','App\Http\Controllers\SellerController@GetSellerUnreadMsg');

    // Get Seller click Unread Msg ----->Seller Page 
    Route::post('view_new_msg_by_seller','App\Http\Controllers\SellerController@GetSellerClickUnreadMsg');

    // Mark Read Msg ----->Seller Page
    Route::post('markMsReadSeller','App\Http\Controllers\SellerController@MarkAsMsgRead');

    // View Statu usin Notificatin Seller Msg  ----->Seller Page
    Route::post('ViewStatusUsingNotifMsgSeller','App\Http\Controllers\SellerController@Get_Status');

    // Load All Notifications ---> Seller Page
    Route::get('allNotification','App\Http\Controllers\SellerController@AllNotification');

    // View All Notificatin Seller Msg  ----->Seller Page
    Route::post('GetallNotification','App\Http\Controllers\SellerController@LoadAllSellerMsg');

    // View All Notificatin Seller Msg  ----->Seller Page
    Route::post('delete_seller_msg','App\Http\Controllers\SellerController@DeleteThisSellerMsg');

    // View profile Pag Load Seller Msg  ----->Seller Page
    Route::get('viewMyProfileSeller','App\Http\Controllers\SellerController@LoadSellerProfilePg');

    // Load Seller profile data ----->Seller Page
    Route::post('load_SellerProFile','App\Http\Controllers\SellerController@LoadSellerFrofile');

    // update Seller profile data ----->Seller Page
    Route::post('updateSellerProfile','App\Http\Controllers\SellerController@UpDateSellerFrofile');

    // update Seller password data ----->Seller Page
    Route::post('updateSellerPw','App\Http\Controllers\SellerController@UpDateSellerPWUpdate');
    
});