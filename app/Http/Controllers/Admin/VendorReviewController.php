<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Review;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class VendorReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return view('backend.admin.vendor_review.index',compact('reviews'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function view($id){
        $review = Review::find($id);
        if($review->viewed == 0){
            $review->viewed = 1;
            $review->save();
        }
        return view('backend.admin.vendor_review.show',compact('review'));
    }

    public function reviewUpdate(Request $request, $id) {
        $review = \App\Review::find($id);
        $review->comment = $request->comment;
        $review->save();
        Toastr::success('Review Updated Successfully');
        return redirect()->route('admin.review.index');
    }

    public function updateStatus(Request $request){
        $review = Review::findOrFail($request->id);
        $review->status = $request->status;
        if($review->save()){
            return 1;
        }
        return 0;
    }
}
