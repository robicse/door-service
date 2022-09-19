<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Admin\ServiceSubCategoryController;
use App\Order;
use App\OrderVendor;
use App\Payment;
use App\ServiceCategory;
use App\ServiceManage;
use App\ServicesSubCategory;
use App\VendorDetails;
use App\VendorGallery;
use App\VendorLocation;
use App\VendorService;
use App\VendorWithdrawRequest;
use Brian2694\Toastr\Facades\Toastr;
/*use Illuminate\Foundation\Auth\User;*/
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use function Composer\Autoload\includeFile;

class VendorController extends Controller
{
    public function dashboard()
    {
        $vendorOrders = OrderVendor::where('vendor_id', Auth::id())->latest()->get();
        $acceptedOrders = Order::where('status_id',1)->where('vendor_id', Auth::id())->count();
        $pendingOrders = Order::where('status_id',2)->where('vendor_id', Auth::id())->count();
        $onReviewOrders = Order::where('status_id',3)->where('vendor_id', Auth::id())->count();
        $completedOrders = Order::where('status_id',4)->where('vendor_id', Auth::id())->count();
        $canceledOrders = Order::where('status_id',5)->where('vendor_id', Auth::id())->count();
        return view('backend.vendor.dashboard',compact('vendorOrders','acceptedOrders','pendingOrders','onReviewOrders','completedOrders','canceledOrders'));
    }
    public function profileUpdate($id){
          $vendor = User::find($id);
          $nidImages = VendorGallery::where('user_id',Auth::id())->where('type','nid')->get();
          $jobImages = VendorGallery::where('user_id',Auth::id())->where('type','jobs')->get();
          $TLImages = VendorGallery::where('user_id',Auth::id())->where('type','trade_license')->get();
          $shopImages = VendorGallery::where('user_id',Auth::id())->where('type','shop')->get();
          $service_category = ServiceCategory::all();
          $service_sub_category = ServicesSubCategory::all();
          $vendorService = VendorService::where('vendor_id', Auth::id())->get();
          $vendorLocations = VendorLocation::where('vendor_id', Auth::id())->get();
          $vendor_details = VendorDetails::where('user_id',$vendor->id)->first();
          //dd();
            if ($vendor_details->account_category == 'individual')
            {
                return view('backend.vendor.update_profile_individual',
                    compact('vendor','vendor_details', 'service_category',
                        'service_sub_category','nidImages','jobImages','vendorService','vendorLocations'));
            }else {
                return view('backend.vendor.update_profile_company',
                    compact('vendor','vendor_details', 'service_category',
                        'service_sub_category','nidImages','jobImages','TLImages',
                        'shopImages','vendorService','vendorLocations'));
            }
    }

    public function ajaxSubCat($id){
            $Sub_Cate_data = ServicesSubCategory::where('category_id',$id)->get();
            return response()->json(['success'=> true, 'response'=>$Sub_Cate_data]);
    }

    public function ajaxSubCatWiseService($id)
    {
        $Sub_wise_service_data = ServiceManage::where('sub_category',$id)->get();
        return response()->json(['success'=> true, 'response'=>$Sub_wise_service_data]);
    }

    public function profileUpdateAc(Request $request){
        //dd($request->all());
        $service_category = ServiceCategory::all();
        $vendor_profile_update = VendorDetails::where('user_id', Auth::id())->first();

        if($request->practical_experiences == 'Yes'){
            $month = $request->month;
            $year =  $request->year;
        }else{
            $month = NULL;
            $year =  NULL;
        }
        $vendor_profile_update->vendor_company_name = $request->vendor_company_name;
        $vendor_profile_update->service_category = $request->service_category;
        $vendor_profile_update->sub_service_category = $request->sub_service_category;
        $vendor_profile_update->address = $request->address;
        $vendor_profile_update->practical_experiences = $request->practical_experiences;
        $vendor_profile_update->month = $month;
        $vendor_profile_update->year = $year;
        $vendor_profile_update->ven_service_provide_schedule = $request->ven_service_provide_schedule;
        $vendor_profile_update->ven_service_provide_time = $request->ven_service_provide_time;

        if ($request->area !=''){
            $vendor_profile_update->services_longitude = $request->longitude;
            $vendor_profile_update->services_latitude = $request->latitude;
            $vendor_profile_update->services_city = $request->city;
            $vendor_profile_update->services_area = $request->area;
        }

        $vendor_profile_update->trade_license_number = $request->trade_license_number;
        $vendor_profile_update->validity_of_license = $request->validity_of_license;
        $vendor_profile_update->bank_account_number = $request->bank_account_number;

        //$vendor_profile_update->trade_lic_incorporation_copy = $request->description;
        //$vendor_profile_update->upload_clear_photo_showroom = $request->description;
        //$vendor_profile_update->vendor_image = $request->description;
        //$vendor_profile_update->vendor_nid = $request->description;
        $vendor_profile_update->short_bio = $request->short_bio;

        //$vendor_profile_update->comple_service_photo = $request->description;
        $vendor_profile_update->vendor_feedback = $request->vendor_feedback;
        $vendor_profile_update->professional_ref_name = $request->professional_ref_name;
        $vendor_profile_update->professional_ref_number = $request->professional_ref_number;
        $vendor_profile_update->personal_ref_name = $request->personal_ref_name;
        $vendor_profile_update->personal_ref_mobile = $request->personal_ref_mobile;

        $vendor_profile_update->save();
        Toastr::success('Vendor Profile Updated Successfully', 'Success');
        return redirect()->back();
    }
    public function VendorServices(Request $request)
    {
        //dd($request->all());
        //$vendor=VendorDetails::where('user_id',Auth::id())->first();
        if(!empty($request->service_id)) {
            for ($i =0; $i < count($request->service_id); $i++ ){
                $vendorService = new VendorService();
                $vendorService->vendor_id = Auth::id();
                $vendorService->category_id = $request->category_id;
                $vendorService->subcategory_id = $request->subcategory_id;
                $vendorService->service_id = $request->service_id[$i];
//            $vendorService->area = $vendor->services_area;
//            $vendorService->lat = $vendor->services_latitude;
//            $vendorService->lng = $vendor->services_longitude;
                $check = VendorService::where('vendor_id', Auth::id())->where('service_id', $request->service_id[$i])->first();
                if (empty($check)){
                    $vendorService->save();
                }else{
                    //Toastr::warning('your selected service 1 already selected before', 'Success');
                }
            }
            Toastr::success('Vendor Service Added Successfully', 'Success');
            return redirect()->back();
        }else {
            Toastr::warning('Please select a service', 'Warning');
            return redirect()->back();
        }

    }
    public function VendorServicesUpdated(Request $request, $id)
    {
        $check = VendorService::where('vendor_id', Auth::id())->where('service_id', $request->service_id)->first();
        if (!empty($check)) {
            Toastr::warning('Your Selected service already added! Please select another one', 'Success');
            return redirect()->back();
        }else{
            $vsup = VendorService::find($id);
            $vsup->service_id = $request->service_id;
            Toastr::success('Vendor Service Added Successfully', 'Success');
            return redirect()->back();
        }

    }

    public function VendorServicesDelete($id)
    {
        //dd($id);
        $vs = VendorService::find($id);
        $vs->delete();
        Toastr::success('Your Selected Service Deleted Successfully.', 'Success');
        return redirect()->back();
    }

    public function withdrawRequest()
    {
        $vendor = VendorDetails::where('user_id',Auth::id())->first();
        $payment = VendorWithdrawRequest::where('user_id', Auth::id())->latest()->get();

        $withdrawRequests = VendorWithdrawRequest::latest()->get();
        //dd($withdrawRequests);
        return view('backend.vendor.withdraw_request', compact('withdrawRequests','vendor','payment'));
    }

    public function paymentHistory()
    {
        $paymentHistories = Payment::latest()->get();
        return view('backend.vendor.payment_history',compact('paymentHistories'));
    }
}
