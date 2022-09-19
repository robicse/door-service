<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function Index()
    {
        $staffs=Staff::all();
        return view('frontend.pages.about',compact('staffs'));
    }
    public function monitoring()
    {
        return view('frontend.pages.monitoring');
    }
    public function category()
    {
        return view('test');
    }
    public function checkcategory($id)
    {
        $category=Category::find($id);
        return view('test');
    }
}
