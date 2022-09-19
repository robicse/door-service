<?php

namespace App\Http\Controllers\Admin;

use App\Career;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CareerController extends Controller
{

    public function index()
    {
        $career = Career::latest()->get();
        return view('backend.admin.career.index',compact('career'));
    }

    public function create()
    {
        return view('backend.admin.career.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' =>  'required',
            'education' =>  'required',
            'experience' =>  'required',
            'deadline' =>  'required',
            'description' =>  'required',
            'email' =>  'required',
        ]);

        $career = new Career();
        $career->title = $request->title;
        $career->slug = Str::slug($request->title);
        $career->education = $request->education;
        $career->experience = $request->experience;
        $career->deadline = $request->deadline;
        $career->description = $request->description;
        $career->email = $request->email;
        $career->save();
        Toastr::success('Career form created successfully !');
        return redirect()->route('admin.career.index');
    }

    public function show($id)
    {
        $career = Career::find($id);
        return view('backend.admin.career.show',compact('career'));
    }

    public function edit($id)
    {
        $career = Career::find($id);
        return view('backend.admin.career.edit',compact('career'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' =>  'required',
            'education' =>  'required',
            'experience' =>  'required',
            'deadline' =>  'required',
            'description' =>  'required',
            'email' =>  'required',
        ]);

        $career = Career::find($id);
        $career->title = $request->title;
        $career->slug = Str::slug($request->title);
        $career->education = $request->education;
        $career->experience = $request->experience;
        $career->deadline = $request->deadline;
        $career->description = $request->description;
        $career->email = $request->email;
        $career->save();
        Toastr::success('Career form Updated successfully !');
        return redirect()->route('admin.career.index');
    }

    public function destroy($id)
    {
        $career = Career::find($id);
        $career->delete();
        Toastr::success('Career form Deleted Successfully Done!');
        return redirect()->route('admin.career.index');
    }
}
