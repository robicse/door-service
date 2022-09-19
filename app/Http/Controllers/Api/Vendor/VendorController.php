<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorDetailDataCollections;
use App\Http\Resources\VendorServiceDataCollections;
use App\Http\Resources\WithdrawRequestCollection;
use App\Notification;
use App\Order;
use App\Review;
use App\ServiceCategory;
use App\ServiceManage;
use App\User;
use App\VendorDetails;
use App\VendorGallery;
use App\VendorService;
use App\VendorWithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class VendorController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;
    public function dashboard($id){
        $vendor_details = VendorDetails::where('user_id',$id)->first();
        $success['current_balance'] =(double) $vendor_details->admin_to_pay;
        $success['total_earning'] = Order::where('vendor_id',$id)->where('status_id',4)->sum('grand_total');
        $success['total_ongoing_order'] = Order::where('vendor_id',$id)->where('status_id','!=',4)->count();
        $success['total_completed_order'] = Order::where('vendor_id',$id)->where('status_id',4)->count();
        $success['total_withdraw'] = VendorWithdrawRequest::where('user_id',$id)->where('status',1)->sum('amount');
        $success['notification'] = Notification::where('to',$id)->where('is_read',0)->count();
        $success['review'] = Review::where('vendor_user_id',$id)->count();
        $success['ratings'] =(double) vendorRating($id);

        return response()->json(['success'=> 'true', 'response'=>$success], $this-> successStatus);
    }
    public function review($id){
        $reviews = DB::table('reviews')
            ->join('users','users.id','=','reviews.user_id')
            ->where('vendor_user_id','=',$id)
            ->select('users.name as customer_name','reviews.rating as rating','reviews.comment as comment')
            ->orderBy('reviews.created_at','DESC')
            ->get();
        return response()->json(['success'=> 'true', 'response'=>$reviews], $this-> successStatus);
    }

    public function withdrwRequestHistory($id){
        $withdrawRequest = VendorWithdrawRequest::where('user_id',$id)->latest()->get();
        return new WithdrawRequestCollection($withdrawRequest);
    }
    public function withdrwRequest(Request $request,$id){
        $vendorDetails = VendorDetails::where('user_id',$id)->first();
        if($vendorDetails->admin_to_pay >= $request->amount ) {
            $new_pay = new VendorWithdrawRequest();
            $new_pay->user_id= $id;
            $new_pay->amount = $request->amount;
            $new_pay->message = $request->message;
            $new_pay->status = 0;
            $new_pay->viewed = 0;
            $new_pay->save();
            $vendorDetails->admin_to_pay -= $request->amount;
            $vendorDetails->save();
            return response()->json(['success'=> true, 'response'=>'Request inserted successfully'], $this-> successStatus);

        } else {
            return response()->json(['success'=> false, 'response'=>'You do not have enough balance to send withdraw request'], $this->failStatus);
        }
    }

    public function personalInfoUpdate(Request $request,$id){
        $user = User::find($id);
        $user->name = $request->name;

        $image = $request->file('image');
        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //resize image for banner and upload
            $BannerImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/profile/'. $imagename, $BannerImage);
        }else{

            $imagename = $user->image;
        }
        $user->image = $imagename;
        $vendor = $user->save();
        if (!empty($vendor)){
            return response()->json(['success'=> true, 'response'=>'Profile updated successfully'], $this-> successStatus);
        }else{
            return response()->json(['success'=> false, 'response'=>'Something went wrong'], $this-> failStatus);
        }

    }
    public function documentUpdate(Request $request,$id){

        $images = $request->file('image');

        if(isset($images)){
            foreach($images as $image){
                $currentDate = Carbon::now()->toDateString();
                $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                if($request->type == 'jobs'){
                    $BannerImage = Image::make($image)->resize(800, 450)->save($image->getClientOriginalExtension());
                }else{
                    $BannerImage = Image::make($image)->save($image->getClientOriginalExtension());
                }
                Storage::disk('public')->put('uploads/vendor/'.$request->type.'/'. $imagename, $BannerImage);
                $gallery = new VendorGallery();
                $gallery->user_id = $id;
                $gallery->type = $request->type;
                $gallery->image = $imagename;
                $gallery->save();
                $success['gallery_image_id'] = $gallery->id;
                $success['message'] = 'Image updated successfully';
                return response()->json(['success'=> true, 'response'=>$success], $this-> successStatus);
            }
        }else{
            return response()->json(['success'=> false, 'response'=>'Something went wrong'], $this-> failStatus);
        }

    }
    public function documentDelete($id){

        $gallery = VendorGallery::find($id);
        //delete old image.....
        if ($gallery->type == 'nid') {
            if (Storage::disk('public')->exists('uploads/vendor/nid/'. $gallery->image)) {
                Storage::disk('public')->delete('uploads/vendor/nid/'. $gallery->image);
            }
        }else{
            if (Storage::disk('public')->exists('uploads/vendor/jobs/'. $gallery->image)) {
                Storage::disk('public')->delete('uploads/vendor/jobs/'. $gallery->image);
            }
        }
        $gallery->delete();
        return response()->json(['success'=> true, 'response'=>'Image Successfully Deleted'], $this-> successStatus);

    }
    public function getserviceInfo($id){
        $vendor_services = VendorService::where('vendor_id', $id)->get();
        return new VendorServiceDataCollections($vendor_services);
    }
    public function serviceInfoCreate(Request $request, $vendor_id){

        if(!empty($request->service_id)) {

            for ($i =0; $i < count($request->service_id); $i++ ){
                $vendorService = new VendorService();
                $vendorService->vendor_id = $vendor_id;
                $vendorService->category_id = $request->category_id;
                $vendorService->subcategory_id = $request->subcategory_id;
                $vendorService->service_id = $request->service_id[$i];
                $check = VendorService::where('vendor_id', $vendor_id)->where('service_id', $request->service_id[$i])->first();
                if (empty($check)){
                    $vendorService->save();
                }else{
                    //Toastr::warning('your selected service 1 already selected before', 'Success');
                }
            }
            return response()->json(['success'=> true, 'response'=>'Vendor Service Added Successfully'], $this-> successStatus);

        }else {
            return response()->json(['success'=> false, 'response'=>'Please select a service'], $this-> failStatus);
        }
    }
    public function serviceInfoUpdate(Request $request, $id){

        if(!empty($request->old_service_id)) {
            for ($i =0; $i < count($request->old_service_id); $i++ ){
                $vendorServiceOld = VendorService::where('vendor_id', $id)->where('service_id',$request->old_service_id[$i])->first();
                $vendorServiceOld->delete();
            }
        }

        if(!empty($request->service_id)) {
            for ($i =0; $i < count($request->service_id); $i++ ){
                $serviceManage = ServiceManage::where('id',$request->service_id[$i])->first();
                $vendorService = new VendorService();
                $vendorService->vendor_id = $id;
                $vendorService->category_id = $serviceManage->category_id;
                $vendorService->subcategory_id = $serviceManage->sub_category;
                $vendorService->service_id = $request->service_id[$i];
                $check = VendorService::where('vendor_id', $id)->where('service_id', $request->service_id[$i])->first();
                if (empty($check)){
                    $vendorService->save();
                }
            }
            return response()->json(['success'=> true, 'response'=>'Vendor Service Added Successfully'], $this-> successStatus);

        }else {
            return response()->json(['success'=> false, 'response'=>'Please select a service'], $this-> failStatus);
        }

    }
    public function businessInfoUpdate(Request $request,$id){

        $service_category = ServiceCategory::all();
        $vendor_profile_update = VendorDetails::where('user_id', $id)->first();
        if (empty($vendor_profile_update)){
            $vendor_profile_update = new VendorDetails();
            $vendor_profile_update->user_id = $id;
            $vendor_profile_update->status = 1;
            $vendor_profile_update->save();
        }

        if($request->practical_experiences == 'yes'){
            $month = $request->month;
            $year =  $request->year;
        }else{
            $month = NULL;
            $year =  NULL;
        }
        $vendor_profile_update->account_category = 'company';
        $vendor_profile_update->vendor_company_name = $request->vendor_company_name;
        $vendor_profile_update->trade_license_number = $request->trade_license_number;
        $vendor_profile_update->validity_of_license = $request->validity_of_license;
        $vendor_profile_update->bank_account_number = $request->bank_account_number;
        $vendor_profile_update->ven_service_provide_schedule = $request->ven_service_provide_schedule;
        $vendor_profile_update->ven_service_provide_time = $request->ven_service_provide_time;
        $vendor_profile_update->practical_experiences = $request->practical_experiences;
        $vendor_profile_update->month = $month;
        $vendor_profile_update->year = $year;

        $vendor_profile_update->professional_ref_name = $request->professional_ref_name;
        $vendor_profile_update->professional_ref_number = $request->professional_ref_number;
        $vendor_profile_update->personal_ref_name = $request->personal_ref_name;
        $vendor_profile_update->personal_ref_mobile = $request->personal_ref_mobile;
        $vendor_profile_update->address = $request->address;
        $vendor_profile_update->short_bio = $request->short_bio;
        $vendor_profile_update->vendor_feedback = $request->vendor_feedback;

//        $vendor_profile_update->service_category = $request->service_category;
//        $vendor_profile_update->sub_service_category = $request->sub_service_category;

        if ($request->area !=''){
            $vendor_profile_update->services_longitude = $request->longitude;
            $vendor_profile_update->services_latitude = $request->latitude;
            $vendor_profile_update->services_city = $request->city;
            $vendor_profile_update->services_area = $request->area;
        }

        $vendor_profile_update->save();

        $user = User::find($id);
        if ($user->is_profile_complete != 'Complete'){
            $user->is_profile_complete ='On Review';
        }
        $user->save();
        $success['message'] ='Vendor Business Info Updated Successfully';
        $success['is_profile_complete'] =$user->is_profile_complete;
        if (!empty($vendor_profile_update)){
            return response()->json(['success'=> true, 'response'=>$success], $this-> successStatus);
        }else{
            return response()->json(['success'=> false, 'response'=>'Something went wrong'], $this-> failStatus);
        }

    }
    public function getBusinessInfo($id){
        $vendorProfile = VendorDetails::where('user_id', $id)->get();
        return new VendorDetailDataCollections($vendorProfile);

    }

    public function is_profile_complete($id){
        $user = User::find($id);
        if (!empty($user)){
            return response()->json(['success'=> true, 'response'=>$user->is_profile_complete], $this-> successStatus);
        }else{
            return response()->json(['success'=> false, 'response'=>'Something went wrong'], $this-> failStatus);
        }
    }


}
