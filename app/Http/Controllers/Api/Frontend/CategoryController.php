<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Category;
use App\ServiceCategory;
use App\Http\Controllers\Controller;
use App\ServiceManage;
use App\ServicesSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;

    public function category(){
        $success['category'] = ServiceCategory::all();
        return response()->json(['success'=>$success], $this-> successStatus);
    }
    public function category_list_app(){
        $category = ServiceCategory::select('id','category','icon')->latest()->limit(12)->get();
        return response()->json(['success'=> true, 'response'=>$category], $this-> successStatus);
    }
    public function getCategories(){
        $categories = ServiceCategory::select('id','category')->latest()->get();
        if (!empty($categories)){
            return response()->json(['success'=> true, 'response'=>$categories], $this-> successStatus);
        }else{
            return response()->json(['success'=> false, 'response'=>'Category not found'], 404);
        }
    }
    public function getSubcategories($id){
        $subCategories = ServicesSubCategory::where('category_id',$id)->select('id','sub_category')->latest()->get();
        if (!empty($subCategories)){
            return response()->json(['success'=> true, 'response'=>$subCategories], $this-> successStatus);
        }else{
            return response()->json(['success'=> false, 'response'=>'Subcategory not found'], 404);
        }
    }
    public function getService($id){
        $services = ServiceManage::where('sub_category',$id)->select('id','service_name')->latest()->get();
        if (!empty($services)){
            return response()->json(['success'=> true, 'response'=>$services], $this-> successStatus);
        }else{
            return response()->json(['success'=> false, 'response'=>'Service not found'], 404);
        }
    }

    public function categoryHome(){
        $success['category'] = ServiceCategory::offset(0)->limit(12)->get();
        return response()->json(['success'=>$success], $this-> successStatus);
    }
    public function subCategory(){
        $success['subcategory'] = ServicesSubCategory::join('service_categories', 'service_categories.id', '=', 'services_sub_categories.category_id')
            ->get();
        return response()->json(['success'=>$success], $this-> successStatus);
    }
    public function categoryFind(Request $request){

        $category=ServiceCategory::where('slug',$request->slug)->first();
        $success['subcategory'] = ServicesSubCategory::where('category_id',$category->id)->get();
        //return response($subcategory);
        //dd($success['subcategory']);
        return response()->json(['success'=>$success,'category'=>$category], $this-> successStatus);
    }


    public function categoryAdd(Request $request){
        $this->validate($request,[
            'name'=>'required'
        ]);
        $category = new ServiceCategory();
        $category->category = $request->name;
        $category->slug =Str::slug ($request->name);
        $category->save();
        return response()->json($category);
    }

    public function categorySubcategoryService(Request $request)
    {
        $result = Array();
        $categories = ServiceCategory::all();
        foreach ($categories as $category){
            $subcategories = ServicesSubCategory::where('category_id', $category->id)->get();
            foreach ($subcategories as $subcategory){
                $services = ServiceManage::where('sub_category',$subcategory->id)->get();
                $subcategory->service = (sizeof($services) > 0) ? $services : false;
            }

            $category->subcategories = (sizeof($subcategories) > 0) ? $subcategories : false;
            array_push($result, $category);
        }

        //$success['question'] =
        return response()->json(['success'=> $result], $this-> successStatus);

    }
    public function allService(Request $request)
    {

        $service = ServiceManage::all();
        //$success['question'] =
        return response()->json(['success'=> $service], $this-> successStatus);

    }

}
