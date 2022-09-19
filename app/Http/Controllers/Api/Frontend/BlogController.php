<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;
    public function allBlog()
    {
        $success['blogs'] = DB::table('blogs')
            ->join('service_categories','blogs.service_category_id','service_categories.id')
            ->select('blogs.*','service_categories.category')
            ->latest('blogs.id')->get();

        return response()->json(['success'=>$success], $this-> successStatus);
    }

    public function categoryAllBlog(Request $request)
    {
        $success['blogs'] = DB::table('blogs')
            ->join('service_categories','blogs.service_category_id','service_categories.id')
            ->where('blogs.service_category_id',$request->service_category_id)
            ->select('blogs.*','service_categories.category')
            ->latest('blogs.id')->get();

        return response()->json(['success'=>$success], $this-> successStatus);
    }

    public function blogDetails(Request $request)
    {
        $success['blog'] = DB::table('blogs')
            ->join('service_categories','blogs.service_category_id','service_categories.id')
            ->select('blogs.*','service_categories.category')
            ->where('blogs.id',$request->blog_id)
            ->first();

        return response()->json(['success'=>$success], $this-> successStatus);
    }
}
