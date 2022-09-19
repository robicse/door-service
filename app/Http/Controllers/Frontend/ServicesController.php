<?php

namespace App\Http\Controllers\Frontend;

use App\Order;
use App\Service;
use App\ServiceAd;
use App\ServiceCategory;
use App\ServiceContactDetails;
use App\ServiceSubcategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ServicesController extends Controller
{
//    public function ServiceList()
//    {
//        $categories = ServiceCategory::all();
//        $services = Service::latest()->paginate(40);
//        $ads = ServiceAd::latest()->get();
//        return view('Frontend.Pages.services', compact('categories','services', 'ads'));
//    }
//    public function ServiceCategoryList($slug)
//    {
//        $cat= ServiceCategory::where('slug',$slug)->first();
//        $services = Service::where('service_category_id', $cat->id)->latest()->paginate(24);
//        $categories = ServiceCategory::all();
//        $ads = ServiceAd::latest()->get();
//        return view('Frontend.Pages.category_services', compact('cat','services','categories', 'ads'));
//    }
//    public function subCategoryService($slug)
//    {
//        $subCategory= ServiceSubcategory::where('slug',$slug)->first();
//        $services = Service::where('service_subcategory_id', $subCategory->id)->latest()->paginate(24);
//        $categories = ServiceCategory::all();
//        $ads = ServiceAd::latest()->get();
//        return view('Frontend.Pages.subcategory_services', compact('services','categories','subCategory', 'ads'));
//    }
//    public function serviceDetails($slug)
//    {
//        //dd($slug);
//        $service = Service::where('slug', $slug)->first();
//        $categories = ServiceCategory::all();
//        return view('Frontend.Pages.services_details', compact('service','categories'));
//    }
//    public function serviceOrder($slug)
//    {
//        $service = Service::where('slug', $slug)->first();
//        return view('Frontend.Pages.service_contact', compact('service'));
//    }



}
