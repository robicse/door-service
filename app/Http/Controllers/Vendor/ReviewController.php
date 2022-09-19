<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function customerReview(){
        $reviews = Review::where('vendor_user_id',Auth::user()->id)->latest()->get();
        return view('backend.vendor.review',compact('reviews'));
    }
}
