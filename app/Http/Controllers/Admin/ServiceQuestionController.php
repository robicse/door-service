<?php

namespace App\Http\Controllers\Admin;


use App\Service;
use App\ServiceDetail;
use App\ServiceManage;
use App\ServiceQuestionOption;
use App\ServicesSubCategory;
use App\ServiceSubcategory;
use App\ServiceQuestion;
use App\ServiceCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ServiceQuestionController extends Controller
{

    public function index()
    {
        //dd(":test");
        $services = ServiceManage::latest()->get();

        return view('backend.admin.Services.services-question.index', compact('services'));
    }
    public function add($id){
        //dd($id);
        $service_name = ServiceManage::find($id);
        return view('backend.admin.Services.services-question.create', compact('service_name'));
    }

    public function list($id){
        $services_question = ServiceQuestion::where('service_id', $id)->get();
        return view('backend.admin.Services.services-question.list', compact('services_question'));
    }

    public function create()
    {
        $services = ServiceManage::latest()->get();
        $service_category = ServiceCategory::all();
        $service_sub_category = ServicesSubCategory::all();

        return view('backend.admin.Services.services-question.create', compact('services', 'service_category', 'service_sub_category'));
    }

    public function ajaxSubCat($id)
    {
        $Sub_Cate_data = ServicesSubCategory::where('category_id', $id)->get();
        return response()->json(['success' => true, 'response' => $Sub_Cate_data]);
    }

    /*public function getSubcategory(Category $category)
    {
        return $sub_category->services_sub_category()->select('id', 'sub_category')->get();
    }*/

    public function store(Request $request)
    {
        //dd($request->is_optional);

        $this->validate($request, [
            'service_id' => 'required',
            'question' => 'required',
            'question_type' => 'required',
        ]);

        for ($i=0; $i < count($request->question); $i++) {
            $service = new ServiceQuestion();
            $service->service_id = $request->service_id;
            $service->question = $request->question[$i];
            $service->question_type = $request->question_type[$i];
            $service->is_optional = $request->is_optional[$i];
            $service->save();
        }

        Toastr::success('Service Questions Inserted Successfully Done!');
        return redirect()->route('admin.services-question.index');
    }

    public function serviceWiseQuestionList($id)
    {
        $service = ServiceManage::where('id',$id)->select('service_name')->first();
        $serviceData = ServiceQuestion::where('service_id', $id)->get();
        return view('backend.admin.Services.services-question.service_wise_question_list',compact('serviceData','service'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        $service = Service::find($id);
        // dd($service);
        return view('backend.admin.Services.service.edit', compact('service'));
    }


    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
        ]);
        $service = Service::find($id);
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
        $current_pdf = $service->pdf;
        //dd($service);
        $pdf = $request->file('pdf');
        if (!empty($pdf)) {
            $currentDate = Carbon::now()->toDateString();
            $filename = $currentDate . '-' . uniqid() . '.' . $pdf->getClientOriginalExtension();
            if (Storage::disk('public')->exists('uploads/service/pdf/' . $service->pdf)) {
                Storage::disk('public')->delete('uploads/service/pdf/' . $service->pdf);
            }
            $destinationPath = 'uploads/service/pdf/';
            $pdf->move($destinationPath, $filename);
        } else {
            $filename = $current_pdf;
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
        if (Storage::disk('public')->exists('uploads/service/' . $service->image)) {
            Storage::disk('public')->delete('uploads/service/' . $service->image);
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
        return redirect()->route('admin.services.edit', $request->service_id);
    }

    public function serviceWiseQuestionDelete($id)
    {
        //dd($id);
        $service = ServiceQuestion::find($id);
        $option=ServiceQuestionOption::where('service_question_id',$service->id)->get();
        foreach ($option as $opt){
            $opt->delete();
        }
        $service->delete();
        Toastr::success('Service Question Deleted Successfully!');
        return redirect()->back();
    }

}

