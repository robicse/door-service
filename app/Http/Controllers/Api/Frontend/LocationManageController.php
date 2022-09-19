<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\VendorDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationManageController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;

    public function VendorLocationChecker(Request $request)
    {
        //return response($request->all());

//        $checker = VendorDetails::where('services_area',$request->services_area)->first();

        $lat = $request->user_lat;
        $lng = $request->user_lng;

        $vendors = DB::table('vendor_services')
            ->join('users', 'vendor_services.vendor_id', '=', 'users.id')
            ->join('vendor_details', 'vendor_details.user_id', '=', 'users.id')
            ->select('users.name','users.mobile_number','users.image','vendor_details.services_area','vendor_details.services_latitude','vendor_details.services_longitude','vendor_details.address')
            ->whereBetween('vendor_details.services_latitude',[$lat-0.1,$lat+0.1])
            ->whereBetween('vendor_details.services_longitude',[$lng-0.1,$lng+0.1])
            ->where('users.status',1)
            ->where('vendor_services.service_id',$request->service_id)
            ->get();

        if (count($vendors)!=0) {
            $success['services_area'] = 1;
            $success['vendors'] = $vendors;
        } else {
            $success['services_area'] = 0;
            $success['vendors'] = [];
        }

        return response()->json(['success'=>$success,], $this-> successStatus);
    }
}
