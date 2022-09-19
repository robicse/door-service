<?php

namespace App\Http\Controllers\Admin;

use App\ServiceCategory;
use App\Blog;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('backend.admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        $service_categories = ServiceCategory::all();
        return view('backend.admin.blog.create',compact('service_categories'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=> 'required',
            'service_category_id'=> 'required',
            'description'=> 'required',
            'image'=> 'required',
        ]);
        $post = new Blog();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->service_category_id = $request->service_category_id;
        $post->short_description = $request->short_description;
        $post->description = $request->description;
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for hospital and upload
            $proImage = Image::make($image)->resize(818, 461)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/post/' . $imagename, $proImage);

            //thumbnails
            $proImage = Image::make($image)->resize(330, 350)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/post/thumbnails/' . $imagename, $proImage);
        }else {
            $imagename = "default.png";
        }

        $post->image = $imagename;
        $post->save();
        Toastr::success('Blog Post Created Successfully', 'Success');
        return redirect()->route('admin.blog.index');
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        $service_category = ServiceCategory::where('id',$blog->service_category_id)->pluck('category')->first();
        return view('backend.admin.blog.show',compact('blog','service_category'));
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        $service_categories = ServiceCategory::all();
        return view('backend.admin.blog.edit',compact('blog','service_categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=> 'required',
            'service_category_id'=> 'required',
            'description'=> 'required',
        ]);
        $post =  Blog::find($id);
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->service_category_id = $request->service_category_id;
        $post->short_description = $request->short_description;
        $post->description = $request->description;
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //delete old image.....
            if(Storage::disk('public')->exists('uploads/post/'.$post->image))
            {
                Storage::disk('public')->delete('uploads/post/'.$post->image);
                Storage::disk('public')->delete('uploads/post/thumbnails/'.$post->image);
            }

//            resize image for hospital and upload
            $proImage = Image::make($image)->resize(818, 461)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/post/' . $imagename, $proImage);

            //thumbnails
            $proImage = Image::make($image)->resize(390, 290)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/post/thumbnails/' . $imagename, $proImage);
        }else {
            $imagename = $post->image;
        }

        $post->image = $imagename;
        $post->save();
        Toastr::success('Blog Post Updated Successfully', 'Success');
        return redirect()->route('admin.blog.index');
    }

    public function destroy($id)
    {
        $post = Blog::findOrFail($id);
        //delete old image.....
        if(Storage::disk('public')->exists('uploads/post/'.$post->image))
        {
            Storage::disk('public')->delete('uploads/post/'.$post->image);
            Storage::disk('public')->delete('uploads/post/thumbnails/'.$post->image);
        }
        $post->delete();
        Toastr::success('Blog Post Deleted Successfully', 'Success');
        return redirect()->route('admin.blog.index');
    }
}
