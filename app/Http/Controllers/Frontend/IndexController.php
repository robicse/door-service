<?php

namespace App\Http\Controllers\Frontend;

use App\BlogPost;
use App\Client;
use App\Product;
use App\Service;
use App\Slider;
use App\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function Index()
    {
        $sliders = Slider::latest()->get();
        $clients = Client::all();
        $services = Service::latest()->get();
        return view('frontend.index',compact('clients','sliders','services'));
    }
    public function serviceDetails($slug){
        //dd($slug);
        $services = Service::where('slug',$slug)->first();
        //$Allservices =  Service::where('pdf',$slug)->pluck('pdf')->first();
        //echo $Allservices;
        //exit();
       //dd($Allservices);
        return view('frontend.pages.services',compact('services'));

    }
    public function login(){
        //dd("login");
        return view('auth.admin.admin_auth');
    }

}
