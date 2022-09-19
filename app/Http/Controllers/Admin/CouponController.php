<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Coupon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupon = Coupon::latest()->get();
        return view('backend.admin.coupon.index', compact('coupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {//dd($request->all());

        $this->validate($request, [
            'code' => 'required',
            'type' => 'required'
        ]);

        $cat = new Coupon();
        $cat->code = $request->code;
        $cat->type = $request->type;
        $cat->min_spent = $request->min;
        $cat->status = 0;
        if($request->type=="fixed"){
            $cat->value = $request->value;
        }else{
            $cat->percent_off = $request->value;
        }
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = \Illuminate\Support\Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.coup-' . $image->getClientOriginalExtension();
            //delete old image.....
            if(Storage::disk('public')->exists('uploads/coupon/'.$cat->image))
            {
                Storage::disk('public')->delete('uploads/coupon/'.$cat->image);
            }

//            resize image for hospital and upload
            $proImage = \Intervention\Image\Facades\Image::make($image)->resize(560, 400)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/coupon/' . $imagename, $proImage);

        }else {
            $imagename= "default.png";
        }
        $cat->image = $imagename;
        $cat->save();
        Toastr::success('Coupon Created Successfully', 'Success');
        return redirect()->route('admin.coupon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::find($id);
        return view('backend.admin.category.edit',compact('cat'));
    }
    public function status($id)
    {
        $coup = Coupon::find($id);
        if($coup->status==1){
           $coup->status=0;
        }else{
           $coup->status=1;
        }
         $coup->update();
      return redirect()->route('admin.coupon.index');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        $this->validate($request, [
//            'name' => 'required'
//        ]);
//        $cat = Category::find($id);
//        $cat->name = $request->name;
//        $cat->slug = Str::slug($request->name);
//        $image = $request->file('image');
//        if (isset($image)) {
//            //make unique name for image
//            $currentDate = Carbon::now()->toDateString();
//
//            //delete old image.....
//            if(Storage::disk('public')->exists('uploads/service/'.$cat->image))
//            {
//                Storage::disk('public')->delete('uploads/service/'.$cat->image);
//            }
//            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            //thumbnails
//            $proImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
//            Storage::disk('public')->put('uploads/service/' . $imagename, $proImage);
//        }else {
//            $imagename = $cat->image;
//        }
//        $cat->image = $imagename;
//        $cat->save();
//        Toastr::success('Category Updated Successfully', 'Success');
//        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coupon::destroy($id);
        Toastr::success('Coupon Deleted Succesfully', 'Success');
        return redirect()->route('admin.coupon.index');
    }
}
