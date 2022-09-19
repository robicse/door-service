<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\VendorDetails;
use App\VendorService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorListController extends Controller
{
    public function index(){
//        if (Auth::user()->role_id == 2) {
        //$users = User::where('role_id' ,2)->get();
        //dd($users);
        $vendorUsers = VendorDetails::latest()->get();

//         dd($vendorUsers);
            return view('backend.admin.vendorAll.vendorList',compact('vendorUsers'));
//        }

    }
    public function changeStatus(Request $request ){
        //dd($request->id);
        $vendorUsers = VendorDetails::findorfail($request->id);
        if(isset($request->id))
        {
            $vendorUsers->status = 0;
        }else{
            $vendorUsers->status = 1;
        }
        $vendorUsers->save();
        return redirect()->back();

    }
    public function activeStatus(){
        $vendorUsers = VendorDetails::where('status',1)->get();
            return view('backend.admin.vendorAll.activeVendorlist',compact('vendorUsers'));
        ;
    }

    public function changeStatusPending($id)
    {
        //dd($id);
        $vendorUsers = VendorDetails::find($id);
        //dd($vendorUsers);
        $vendorUsers->status = 0;
        $vendorUsers->save();
        Toastr::success('Vendor Status Change to Pending','Success');
        return redirect()->back();
    }

    public function changeStatusApproved($id)
    {
        //dd($id);
        $vendorUsers = VendorDetails::find($id);
        //dd($vendorUsers);
        $vendorUsers->status = 1;
        $vendorUsers->save();
        $user = User::find($vendorUsers->user_id);
        $user->is_profile_complete = 'Complete';
        $user->save();
        Toastr::success('Vendor Status Change to Approved','Success');
        return redirect()->back();
    }
    public function vendorDelete($id){
        $vendorDetails = VendorDetails::find($id);
        $user = User::find($vendorDetails->user_id);
        $vendorDetails->delete();
        $user->delete();
        Toastr::success('Vendor Deleted Successfully','Success');
        return redirect()->back();
    }


    public function inActiveStatus(){
        $vendorUsers = VendorDetails::where('status',0)->get();
            return view('backend.admin.vendorAll.inActiveVendorlist',compact('vendorUsers'));
        ;
    }

//    public function StatusSuspent(){
//        $vendorUsers = VendorDetails::where('status',2)->get();
//            return view('backend.vendorAll.activeVendorlist',compact('vendorUsers'));
//    }

    public function StatusSuspent(){
        $vendorUsers = VendorDetails::where('status',2)->get();
            return view('backend.admin.vendorAll.activeVendorlist',compact('vendorUsers'));
        ;
    }

    public function userList(){
            $users = User::where('role_id',3)->get();
            //dd($users);
            return view('backend.admin.userList',compact('users'));
        ;
    }

     public function vendorDetails($id)
     {
        $vendorData = VendorDetails::find($id);
        $vendorService = VendorService::where('vendor_id', $vendorData->user_id)->get();
        $vendorUserData = User::find($vendorData->user_id);
        //dd($vendorUserData);
        //dd($vendorService);
         return view('backend.admin.vendorAll.showDetails', compact('vendorData','vendorService', 'vendorUserData'));
     }
}
