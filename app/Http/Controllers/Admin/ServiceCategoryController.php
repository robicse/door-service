<?php

namespace App\Http\Controllers\Admin;

use App\ServiceCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ServiceCategoryController extends Controller
{

    public function index()
    {
        $services_category = ServiceCategory::latest()->get();
        return view('backend.admin.Services.services-category.index',compact('services_category'));
    }


    public function create()
    {
        return view('backend.admin.Services.services-category.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'category' => 'required',

        ]);
        $service_category = new ServiceCategory();
        $service_category->category = $request->category;
        $service_category->short_description = $request->title;
        $service_category->description = $request->description;
        $service_category->slug = Str::slug($request->category);

        $bannerImage = $request->file('banner');
        if (isset($bannerImage)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $banner_image_name = $currentDate . '-' . uniqid() . '.' . $bannerImage->getClientOriginalExtension();
//            resize image for project and upload
            $banImage = Image::make($bannerImage)->save($bannerImage->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/category/'.$banner_image_name, $banImage);
        }
        else {
            $banner_image_name = "default.png";
        }
        $service_category->image = $banner_image_name;

        $iconImage = $request->file('icon');
        if (isset($iconImage)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $icon_image_name = $currentDate . '-' . uniqid() . '.' . $iconImage->getClientOriginalExtension();
//            resize image for project and upload
            $catIconImage = Image::make($iconImage)->save($iconImage->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/category/icon/'.$icon_image_name, $catIconImage);
        }
        else {
            $icon_image_name = "default.png";
        }
        $service_category->icon = $icon_image_name;
        $service_category->save();
        Toastr::success('Service Category Inserted Successfully Done!');
        return redirect()->route('admin.services-category.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        $service_cate_data = ServiceCategory::find($id);
        // dd($service);
        return view('backend.admin.Services.services-category.edit', compact('service_cate_data'));
    }


    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'category' => 'required',
        ]);

        $service_cate_edit = ServiceCategory::find($id);

        $service_cate_edit->category = $request->category;
        $service_cate_edit->short_description = $request->title;
        $service_cate_edit->description = $request->description;
        $service_cate_edit->slug = Str::slug($request->category);

        if (isset($request->banner)) {
            $bannerImage = $request->file('banner');
            if (isset($bannerImage)) {
                //make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $banner_image_name = $currentDate . '-' . uniqid() . '.' . $bannerImage->getClientOriginalExtension();
                //resize image for project and upload
                $banImage = Image::make($bannerImage)->save($bannerImage->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/category/'.$banner_image_name, $banImage);
            }
            else {
                $banner_image_name = "default.png";
            }
            $service_cate_edit->image = $banner_image_name;
        }
        if (isset($request->icon)) {
            $iconImage = $request->file('icon');
            if (isset($iconImage)) {
                //make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $icon_image_name = $currentDate . '-' . uniqid() . '.' . $iconImage->getClientOriginalExtension();
                //resize image for project and upload
                $catIconImage = Image::make($iconImage)->save($iconImage->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/category/icon/'.$icon_image_name, $catIconImage);
            }
            else {
                $icon_image_name = "default.png";
            }
            $service_cate_edit->icon = $icon_image_name;
        }

        $service_cate_edit->update();

        Toastr::success('Service Category Updated Successfully Done!');
        return redirect()->route('admin.services-category.index');
    }

    public function destroy($id)
    {
        $service_category = ServiceCategory::find($id);
        $service_category->delete();

        Toastr::success('Service Category Deleted Successfully Done!');
        return redirect()->route('admin.services-category.index');
    }

    /*public function slugChange(Request $request)
    {
        //dd($request->all());
        $service = Service::find($request->service_id);
        $service->slug = $request->slug;
        $service->save();
        Toastr::success('Slug change Successfully Done! (^_^)');
        return redirect()->route('admin.services.edit', $request->service_id);
    }*/

}

