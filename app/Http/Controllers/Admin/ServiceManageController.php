<?php


namespace App\Http\Controllers\Admin;

use App\ServiceDetail;
use App\ServiceManage;
use App\ServiceQuestion;
use App\ServicesSubCategory;
use App\ServiceCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ServiceManageController extends Controller
{
    public function index()
    {
        $services = ServiceManage::latest()->get();
        return view('backend.admin.Services.service-manage.index',compact('services'));
    }

    public function create()
    {
        $service_category = ServiceCategory::all();
        $service_sub_category = ServicesSubCategory::all();

        return view('backend.admin.Services.service-manage.create',compact('service_category','service_sub_category'));
    }

    public function ajaxSubCat ($id)
    {
        $Sub_Cate_data = ServicesSubCategory::where('category_id',$id)->get();
        return response()->json(['success'=> true, 'response'=>$Sub_Cate_data]);
    }

    /*public function getSubcategory(Category $category)
    {
        return $sub_category->services_sub_category()->select('id', 'sub_category')->get();
    }*/

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required',

        ]);
        $service = new ServiceManage();

        $service->service_name = $request->name;
        if (empty($request->service_price)) {
            $service->service_price = 0;
        }else {
            $service->service_price = $request->service_price;
        }
        $service->service_type = $request->service_type;
        $service->slug = Str::slug($request->name);
        $service->category_id = $request->service_category;
        $service->sub_category = $request->service_sub_category;

        if ($request->service_category!='' && $request->service_sub_category!='') {
            $service->parent = 'sub_category';
        }else{
            $service->parent = "category";
        }
        $service->description = $request->description;

        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $Mainimg = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for serviceImgae and upload
            $MainImage = Image::make($image)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service/' . $Mainimg, $MainImage);
        } else {
            $Mainimg = NULL;
        }
        $service->image = $Mainimg;

        $icon_image = $request->file('icon_image');
        if (isset($icon_image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $Iconimg = $currentDate . '-' . uniqid() . '.' . $icon_image->getClientOriginalExtension();
//            resize image for serviceImgae and upload
            $iconImage = Image::make($icon_image)->save($icon_image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service/' . $Iconimg, $iconImage);
        } else {
            $Iconimg = NULL;
        }
        $service->icon_image = $Iconimg;
        $service->hot_deal_status = $request->hot_deal_status;
        $service->trending_service_status = $request->trending_service_status;
        $service->recommended_service_status = $request->recommended_service_status;

        $service->save();

        $service_id = $service->id;

        //dd($service_id);
        $service_details = new ServiceDetail();

        $service_details->service_id = $service_id;
        $image_1 = $request->file('image_1');
        if (isset($image_1)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $ima_1 = $currentDate . '-' . uniqid() . '.' . $image_1->getClientOriginalExtension();
//            resize image for serviceImgae and upload
            $Imag_1 = Image::make($image_1)->save($image_1->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service/' . $ima_1, $Imag_1);
        } else {
            $ima_1 = NULL;
        }
        $service_details->image_1 = $ima_1;

        $image_2 = $request->file('image_2');
        if (isset($image_2)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $ima_2 = $currentDate . '-' . uniqid() . '.' . $image_2->getClientOriginalExtension();
//            resize image for serviceImgae and upload
            $Imag_2 = Image::make($image_2)->save($image_2->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service/' . $ima_2, $Imag_2);
        } else {
            $ima_2 = NULL;
        }
        $service_details->image_2 = $ima_2;

        $image_3 = $request->file('image_3');
        if (isset($image_3)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $ima_3 = $currentDate . '-' . uniqid() . '.' . $image_3->getClientOriginalExtension();
//            resize image for serviceImgae and upload
            $Imag_3 = Image::make($image_3)->save($image_3->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service/' . $ima_3, $Imag_3);
        } else {
            $ima_3 = NULL;
        }
        $service_details->image_3 = $ima_3;

        $service_details->find_point = $request->find_point;
        $service_details->how_it_work = $request->how_it_work;

        $service_details->save();

        Toastr::success('Service Inserted Successfully Done!');
        return redirect()->route('admin.services-manage.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $service = ServiceManage::find($id);
        $service_details = \App\ServiceDetail::where('service_id',$service->id)->first();
        if(empty($service_details))
        {
            return redirect()->route('admin.services-manage.index');
        }
        $service_category = ServiceCategory::all();
        $service_sub_category = ServicesSubCategory::all();
        return view('backend.admin.Services.service-manage.edit', compact('service','service_category','service_sub_category','service_details'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'service_name' => 'required',
            'service_category' => 'required',
            'service_sub_category' => 'required',
        ]);
        $service = ServiceManage::find($id);

        $service->service_name = $request->service_name;
        if (empty($request->service_price)) {
            $service->service_price = 0;
        }else {
            $service->service_price = $request->service_price;
        }
        $service->slug = Str::slug($request->service_name);
        $service->service_type = $request->service_type;
        $service->category_id = $request->service_category;
        $service->sub_category = $request->service_sub_category;
        $service->description = $request->description;

        $image = $request->file('image');
        if ($image!='') {
            if (isset($image)) {
                //make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $Mainimg = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                if (Storage::disk('public')->exists('uploads/service/' . $service->image)) {
                    Storage::disk('public')->delete('uploads/service/' . $service->image);
                }
//            resize image for serviceImgae and upload
                $MainImage = Image::make($image)->save($image->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/service/' . $Mainimg, $MainImage);
            } else {
                $Mainimg = $service->image;
            }
            $service->image = $Mainimg;
        }

        $icon_image = $request->file('icon_image');
        if ($icon_image!='') {
            if (isset($icon_image)) {
                $currentDate = Carbon::now()->toDateString();
                $icon_img = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                if (Storage::disk('public')->exists('uploads/service/'. $service->icon_image)) {
                    Storage::disk('public')->delete('uploads/service/'. $service->icon_image);
                }
                $IconImage = Image::make($image)->save($image->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/service/'. $icon_img, $IconImage);
            } else {
                $icon_img = $service->icon_image;
            }
            $service->icon_image = $icon_img;
        }
        $service->hot_deal_status = $request->hot_deal_status;
        $service->trending_service_status = $request->trending_service_status;
        $service->recommended_service_status = $request->recommended_service_status;

        $service->save();

        $service_details = ServiceDetail::where('service_id',$id)->first();

        if (!empty($service_details))

        $service_details->service_id = $id;

        $image_1 = $request->file('image_1');

        if ($image_1 !='') {
            if (isset($image_1)) {
                //make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $ima_1 = $currentDate . '-' . uniqid() . '.' . $image_1->getClientOriginalExtension();
                if (Storage::disk('public')->exists('uploads/service/' . $service_details->image_1)) {
                    Storage::disk('public')->delete('uploads/service/' . $service_details->image_1);
                }
                $Imag_1 = Image::make($image_1)->save($image_1->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/service/'. $ima_1, $Imag_1);
            } else {
                $ima_1 = $service_details->image_1;
            }

            $service_details->image_1 = $ima_1;
        }

        $image_2 = $request->file('image_2');
        if ($image_2 !='') {
            if (isset($image_2)) {
                //make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $ima_2 = $currentDate . '-' . uniqid() . '.' . $image_2->getClientOriginalExtension();
                if (Storage::disk('public')->exists('uploads/service/'. $service_details->image_2)) {
                    Storage::disk('public')->delete('uploads/service/'. $service_details->image_2);
                }
                $Imag_2 = Image::make($image_2)->save($image_2->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/service/'.$ima_2, $Imag_2);
            } else {
                $ima_2 = $service_details->image_2;
            }
            $service_details->image_2 = $ima_2;
        }

        $image_3 = $request->file('image_3');
        if ($image_3 !='') {
            if (isset($image_3)) {
                //make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $ima_3 = $currentDate . '-' . uniqid() . '.' . $image_3->getClientOriginalExtension();
                if (Storage::disk('public')->exists('uploads/service/'.$service_details->image_3)) {
                    Storage::disk('public')->delete('uploads/service/'.$service_details->image_3);
                }
                $Imag_3 = Image::make($image_3)->save($image_3->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/service/' . $ima_3, $Imag_3);
            } else {
                $ima_3 = $service_details->image_3;
            }
            $service_details->image_3 = $ima_3;
        }

        $service_details->find_point = $request->find_point;
        $service_details->how_it_work = $request->how_it_work;

        $service_details->save();

        Toastr::success('Service Updated Successfully Done!');
        return redirect()->route('admin.services-manage.index');

    }

    public function destroy($id)
    {
        $service = ServiceManage::find($id);
        if (Storage::disk('public')->exists('uploads/service/' . $service->image)) {
            Storage::disk('public')->delete('uploads/service/' . $service->image);
        }
        if (Storage::disk('public')->exists('uploads/service/' . $service->icon_image)) {
            Storage::disk('public')->delete('uploads/service/' . $service->icon_image);
        }
        $service->delete();

        $service_details = ServiceDetail::where('service_id', $id)->first();


        if (Storage::disk('public')->exists('uploads/service/' . $service_details->image_1)) {
            Storage::disk('public')->delete('uploads/service/' . $service_details->image_1);
        }
        if (Storage::disk('public')->exists('uploads/service/' . $service_details->image_2)) {
            Storage::disk('public')->delete('uploads/service/' . $service_details->image_2);
        }
        if (Storage::disk('public')->exists('uploads/service/' . $service_details->image_3)) {
            Storage::disk('public')->delete('uploads/service/' . $service_details->image_3);
        }
        $service_details->delete();

        $service_question_del = ServiceQuestion::where('service_id', $id)->get();
            foreach ($service_question_del as $sub)
            {
                if ($sub->service_id == $id) {
                    $sub->delete();
                }

            }
            //exit();
        Toastr::success('Service Deleted Successfully Done!');
        return redirect()->route('admin.services-manage.index');
    }

//    public function ajaxSubCat ($id)
//    {
        //dd($id);
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
        return redirect()->route('admin.services.edit', $request->service_id);
    }

}
