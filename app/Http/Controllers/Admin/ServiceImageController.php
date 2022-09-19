<?php

namespace App\Http\Controllers\Admin;

use App\ServiceImage;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ServiceImageController extends Controller
{

    public function index()
    {
        $serviceImages = ServiceImage::latest()->get();
        return view('backend.admin.Services.serviceImgae.index',compact('serviceImages'));
    }


    public function create()
    {
        return view('backend.admin.Services.serviceImgae.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=> 'required',
            'image'=> 'required',
        ]);
        $serviceImages = new ServiceImage();
        $serviceImages->title = $request->title;
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for hospital and upload
            $proImage =Image::make($image)->resize(818, 461)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service/image/' . $imagename, $proImage);


        }else {
            $imagename = "default.png";
        }

        $serviceImages->image = $imagename;
        $serviceImages->save();
        Toastr::success('Service Image Created Successfully', 'Success');
        return redirect()->route('admin.services_image.index');
    }



    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $serviceImages = ServiceImage::find($id);
        return view('backend.admin.Services.serviceImgae.edit',compact('serviceImages'));

    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=> 'required',
        ]);
        $serviceImages = ServiceImage::find($id);
        $serviceImages->title = $request->title;
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //delete old image.....
            if(Storage::disk('public')->exists('uploads/service/image/'.$serviceImages->image))
            {
                Storage::disk('public')->delete('uploads/service/image/'.$serviceImages->image);
            }
//            resize image for hospital and upload
            $proImage =Image::make($image)->resize(818, 461)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service/image/' . $imagename, $proImage);


        }else {
            $imagename = $serviceImages->image ;
        }

        $serviceImages->image = $imagename;
        $serviceImages->save();
        Toastr::success('Service Image Updated Successfully', 'Success');
        return redirect()->route('admin.services_image.index');
    }

    public function destroy($id)
    {
        //
    }
}
