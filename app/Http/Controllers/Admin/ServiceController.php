<?php

namespace App\Http\Controllers\Admin;

use App\Service;
use App\ServiceSubcategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::latest()->get();
        return  view('backend.admin.Services.service.index', compact('services'));
    }


    public function create()
    {
        return view('backend.admin.Services.service.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required',
            'hotline' => 'required',
        ]);
        $service = new Service();
        $service->name = $request->name;
        $service->slug = $request->slug;
        $service->hotline = $request->hotline;
        $service->meta_title = $request->meta_title;
        $service->meta_description = $request->meta_description;
        $service->description = $request->description;
        $service->home_description = $request->home_description;
        $service->image_alt = $request->image_alt;
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $Mainimg = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for serviceImgae and upload
            $MainImage = Image::make($image)->resize(222, 232)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service/' . $Mainimg, $MainImage);
        } else {
            $Mainimg = NULL;
        }
        $service->image = $Mainimg;

        $pdf = $request->file('pdf');
        $currentDate = Carbon::now()->toDateString();
        $filename = $currentDate . '-' . uniqid() . '.' .$pdf->getClientOriginalExtension();
        Storage::disk('public')->exists('uploads/service/pdf/' . $service->pdf);
        $destinationPath = 'uploads/service/pdf/';
        $pdf->move($destinationPath, $filename);
        $service->pdf = $filename;
        $service->save();
        Toastr::success('Service Inserted Successfully Done!');
        return redirect()->route('admin.services.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        $service =  Service::find($id);
       // dd($service);
        return view('backend.admin.Services.service.edit',compact('service'));
    }


    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
        ]);
        $service =  Service::find($id);
        $service->name = $request->name;
        $service->slug = $request->slug;
        $service->hotline = $request->hotline;
        $service->meta_title = $request->meta_title;
        $service->meta_description = $request->meta_description;
        $service->description = $request->description;
        $service->home_description = $request->home_description;
        $service->image_alt = $request->image_alt;
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $Mainimg = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (Storage::disk('public')->exists('uploads/service/' . $service->image)) {
                Storage::disk('public')->delete('uploads/service/' . $service->image);
            }
//            resize image for serviceImgae and upload
            $MainImage = Image::make($image)->resize(222, 232)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service/' . $Mainimg, $MainImage);
        } else {
            $Mainimg = $service->image;
        }
        $service->image = $Mainimg;
        $current_pdf =$service->pdf;
        //dd($service);
        $pdf = $request->file('pdf');
        if(!empty($pdf)){
            $currentDate = Carbon::now()->toDateString();
            $filename = $currentDate . '-' . uniqid() . '.' .$pdf->getClientOriginalExtension();
            if (Storage::disk('public')->exists('uploads/service/pdf/' . $service->pdf)) {
                Storage::disk('public')->delete('uploads/service/pdf/' . $service->pdf);
            }
            $destinationPath = 'uploads/service/pdf/';
            $pdf->move($destinationPath, $filename);
        }else{
            $filename=  $current_pdf ;
        }
        /*$currentDate = Carbon::now()->toDateString();
        $filename = $currentDate . '-' . uniqid() . '.' .$pdf->getClientOriginalExtension();
        if (Storage::disk('public')->exists('uploads/service/pdf/' . $service->pdf)) {
            Storage::disk('public')->delete('uploads/service/pdf/' . $service->pdf);
        }else{
          $filename=  $current_pdf ;
        }*/
        //dd($filename);

        $service->pdf = $filename;

        $service->save();
        Toastr::success('Service Updated Successfully Done!');
        return redirect()->route('admin.services.index');
    }


    public function destroy($id)
    {
        $service = Service::find($id);
        if (Storage::disk('public')->exists('uploads/service/'.$service->image)) {
            Storage::disk('public')->delete('uploads/service/'.$service->image);
        }
        if (Storage::disk('public')->exists('uploads/service/pdf/' . $service->pdf)) {
            Storage::disk('public')->delete('uploads/service/pdf/' . $service->pdf);
        }
        $service->delete();
        Toastr::success('Service Deleted Successfully Done!');
        return redirect()->route('admin.services.index');
    }

//    public function ajaxSubCat ($id)
//    {
//        //dd($id);
//        $Sub_Cate_data = ServiceSubcategory::where('service_category_id',$id)->get();
//        return response()->json(['success'=> true, 'response'=>$Sub_Cate_data]);
//    }
    public function slugChange(Request $request)
    {
        //dd($request->all());
        $service = Service::find($request->service_id);
        $service->slug = $request->slug;
        $service->save();
        Toastr::success('Slug change Successfully Done! (^_^)');
        return redirect()->route('admin.services.edit',$request->service_id);
    }

}
