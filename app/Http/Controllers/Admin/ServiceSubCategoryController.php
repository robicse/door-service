<?php

namespace App\Http\Controllers\Admin;

use App\ServiceCategory;
use App\ServicesSubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ServiceSubCategoryController extends Controller
{

    public function index()
    {
        $subcategories = ServicesSubCategory::latest()->get();
        return view('backend.admin.Services.subcategory.index', compact('subcategories'));
    }


    public function create()
    {
        $services_cate = ServiceCategory::get();
        return view('backend.admin.Services.subcategory.create', compact('services_cate'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'sub_category' => 'required',
            'service_category_id' => 'required',
        ]);
        $service_sub_category = new ServicesSubCategory();

        $service_sub_category->sub_category = $request->sub_category;
        $service_sub_category->category_id = $request->service_category_id;
        $service_sub_category->slug = Str::slug($request->sub_category);

        $service_sub_category->description = $request->description;

        $bannerImage = $request->file('banner');
        if (isset($bannerImage)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $banner_image_name = $currentDate . '-' . uniqid() . '.' . $bannerImage->getClientOriginalExtension();
//            resize image for project and upload
            $banImage = Image::make($bannerImage)->save($bannerImage->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/sub-category/'.$banner_image_name, $banImage);
        }
        else {
            $banner_image_name = "default.png";
        }
        $service_sub_category->banner = $banner_image_name;

        $image = $request->file('icon');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $image_name = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for project and upload
            $proImage = Image::make($image)->resize(48, 48)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/sub-category/'.$image_name, $proImage);
        }
        else {
            $image_name = "default.png";
        }
        $service_sub_category->icon = $image_name;

        $service_sub_category->save();

        Toastr::success('Service Sub Category Inserted Successfully Done!');
        return redirect()->route('admin.services-sub-category.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $service_sub_cate_data = ServicesSubCategory::find($id);
        $service_category = ServiceCategory::get();
        // dd($service);
        return view('backend.admin.Services.subcategory.edit', compact('service_sub_cate_data', 'service_category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'sub_category' => 'required',
            'service_category_id' => 'required',
        ]);
        $service_sub_cate_edit = ServicesSubCategory::find($id);

        $service_sub_cate_edit->sub_category = $request->sub_category;
        $service_sub_cate_edit->category_id = $request->service_category_id;
        $service_sub_cate_edit->description = $request->description;
        $service_sub_cate_edit->slug = Str::slug($request->sub_category);

        if ($request->banner !='') {
            $bannerImage = $request->file('banner');
            if (isset($bannerImage)) {
                //make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $banner_image_name = $currentDate . '-' . uniqid() . '.' . $bannerImage->getClientOriginalExtension();
//            resize image for project and upload
                $banImage = Image::make($bannerImage)->save($bannerImage->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/sub-category/'.$banner_image_name, $banImage);
            }
            else {
                $banner_image_name = "default.png";
            }
            $service_sub_cate_edit->banner = $banner_image_name;
        }

        if ($request->icon !='') {

            $image = $request->file('icon');
            if (isset($image)) {
                //make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $image_name = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for project and upload
                $proImage = Image::make($image)->resize(48, 48)->save($image->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/sub-category/'.$image_name, $proImage);

            }
            else {
                $image_name = "default.png";
            }
            $service_sub_cate_edit->icon = $image_name;
        }

        $service_sub_cate_edit->save();

        Toastr::success('Service Sub Category Updated Successfully Done!');
        return redirect()->route('admin.services-sub-category.index');
    }

    public function destroy($id)
    {
        $service_sub_category = ServicesSubCategory::find($id);
        $service_sub_category->delete();

        Toastr::success('Service Sub Category Deleted Successfully Done!');
        return redirect()->route('admin.services-sub-category.index');
    }

    public function slugChange(Request $request)
    {
        //dd($request->all());
        $service = Service::find($request->service_id);
        $service->slug = $request->slug;
        $service->save();
        Toastr::success('Slug change Successfully Done! (^_^)');
        return redirect()->route('admin.services.edit', $request->service_id);
    }

}


