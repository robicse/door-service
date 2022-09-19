<?php


namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDataCollections;
use App\ServiceCategory;
use App\ServicesSubCategory;
use App\ServiceQuestion;
use App\ServiceDetail;
use App\ServiceManage;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class         ServiceController
{
    public $successStatus = 200;
    public $failStatus = 401;

    public function service(Request $request){

        // $success['service'] = DB::table('service_manages')
        //    ->join('service_details','service_details.service_id', '=', 'service_manages.id')
        //    ->join('service_categories','service_categories.id', '=', 'service_manages.category_id')
        //    ->join('services_sub_categories', 'services_sub_categories.id', '=', 'service_manages.sub_category')
        //    ->join('service_questions', 'service_questions.service_id', '=', 'service_manages.id')
        //    ->get();
        $subcategory=ServicesSubCategory::where('slug',$request->slug)->first();
        $success['service'] = ServiceManage::where('sub_category',$subcategory->id)->get();
        return response()->json(['success'=>$success,'subcategory'=>$subcategory], $this-> successStatus);
    }

    public function details(Request $request){


        $success['service_details'] = DB::table('service_details')
            ->join('service_manages', 'service_manages.id','=', 'service_details.service_id')
            ->where('service_details.service_id','=',$request->id)
            ->get();

        return response()->json(['success'=>$success], $this-> successStatus);
    }

    public function questionFind(Request $request){

        $success['service_questions']= DB::table('service_questions')
            ->join('service_manages', 'service_manages.id', '=', 'service_questions.service_id')
            ->where('service_questions.service_id','=',$request->id)
            ->get();

        return response()->json(['success'=>$success], $this-> successStatus);
    }

    /*public function order(Request $request){

        $this->validate($request,[
            'name'=>'required'
        ]);
        $category = new ServiceCategory();
        $category->category = $request->name;
        $category->save();
        return response()->json($category);
    }*/

    public function get12Services()
    {
        $success['services'] = ServicesSubCategory::inRandomOrder()->limit(12)->get();;
        return response()->json(['success'=>$success], $this-> successStatus);
    }
    public function serviceByCategory($id){
        $services = ServiceManage::where('category_id',$id)->limit(15)->get();
        return response()->json(['success'=>true, 'response'=>$services], $this-> successStatus);

    }
    public function serviceFilter($type){

        if ($type == 'hot_deal_status'){
            $services = ServiceManage::where('hot_deal_status',1)->limit(15)->get();
        }
        if ($type == 'trending_service_status'){
            $services = ServiceManage::where('trending_service_status',1)->limit(15)->get();
        }
        if ($type == 'recommended_service_status'){
            $services = ServiceManage::where('recommended_service_status',1)->limit(15)->get();

        }
        return response()->json(['success'=>true, 'response'=>$services], $this-> successStatus);

    }
    public function searchServices(Request $request){
        $name = $request->get('q');
        $services = ServiceManage::where('service_name', 'LIKE', '%'. $name. '%')->limit(15)->get();
        if (!empty($services)){
            return response()->json(['success'=>true, 'response'=>$services], $this-> successStatus);
        }else{
            return response()->json(['success'=>false, 'response'=>'Service not found'], 404);
        }

    }

}
