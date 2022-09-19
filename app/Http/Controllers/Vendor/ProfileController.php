<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\User;
use App\VendorGallery;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image*' => 'required|image|mimes:jpeg,bmp,png,jpg|max:100',
        ]);

        $vendor = User::find(Auth::id());
        $vendor->name = $request->name;
        $image = $request->file('image');
        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //resize image for banner and upload
            $BannerImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/profile/'. $imagename, $BannerImage);
        }else{

            $imagename = $vendor->image;
        }
        $vendor->name = $request->name;
        $vendor->image = $imagename;
        $vendor->save();
        Toastr::success('Profile Updated Successfully' ,'Success');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassword))
        {
            if (!Hash::check($request->password,$hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Password Successfully Changed :)' ,'Success');
                Auth::logout();
                return redirect()->route('vendor.reg');
            }else{
                Toastr::error('New Password can not be same as old password :)' ,'Error');
                return redirect()->back();
            }
        }else{
            Toastr::error('Current Password does match. :)' ,'Error');
            return redirect()->back();
        }
    }

    public function GalleryImageStore(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'image*' => 'required|image|mimes:jpeg,bmp,png,jpg|max:2048',
        ]);

        $images = $request->file('image');
        if(isset($images)){
            foreach($images as $image){
                $currentDate = Carbon::now()->toDateString();
                $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                //resize image for banner and upload
                if($request->type == 'jobs'){
                    $BannerImage = Image::make($image)->resize(800, 450)->save($image->getClientOriginalExtension());
                }else{
                    $BannerImage = Image::make($image)->save($image->getClientOriginalExtension());
                }
                Storage::disk('public')->put('uploads/vendor/'.$request->type.'/'. $imagename, $BannerImage);
                $gallery = new VendorGallery();
                $gallery->user_id = Auth::id();
                $gallery->type = $request->type;
                $gallery->image = $imagename;
                $gallery->save();
            }
        }
        Toastr::success('Image Successfully Uploaded' ,'Successful');
        return redirect()->back();
    }
    public function GalleryImageDelete($id)
    {
        $gallery = VendorGallery::find($id);
        //delete old image.....
        if ($gallery->type == 'nid') {
            if (Storage::disk('public')->exists('uploads/vendor/nid/'. $gallery->image)) {
                Storage::disk('public')->delete('uploads/vendor/nid/'. $gallery->image);
            }
        }else{
            if (Storage::disk('public')->exists('uploads/vendor/jobs/'. $gallery->image)) {
                Storage::disk('public')->delete('uploads/vendor/jobs/'. $gallery->image);
            }
        }
        $gallery->delete();
        Toastr::success('Image Successfully Deleted' ,'Successful');
        return redirect()->back();

    }
}
