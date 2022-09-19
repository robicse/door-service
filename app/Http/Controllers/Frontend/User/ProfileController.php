<?php

namespace App\Http\Controllers\Frontend\User;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function editProfile(Request $request)
    {
        return view('Frontend.Users.edit-profile');
    }
    public function updateProfile(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'image'=> 'required',
            'mobile_number'=> 'required',
        ]);
        $user = \App\User::findOrFail(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = \Illuminate\Support\Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //delete old image.....
            if(Storage::disk('public')->exists('uploads/propic/'.$user->image))
            {
                Storage::disk('public')->delete('uploads/propic/'.$user->image);
            }

//            resize image for hospital and upload
            $proImage = \Intervention\Image\Facades\Image::make($image)->resize(100, 100)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/propic/' . $imagename, $proImage);

        }else {
            $imagename= $user->image;
        }
        $user->image = $imagename;
        $user->save();

        Toastr::success('Profile Updated Successfully','Success');
        return redirect()->back();


    }
    public function changedPassword(Request $request)
    {

        return view('Frontend.Users.edit-password');
    }

    public function changedPasswordUpdated(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $hashedPassword = Auth::user()->password;
       // dd($hashedPassword);
        if (Hash::check($request->old_password, $hashedPassword)) {
            //dd('okk');
            if (!Hash::check($request->password, $hashedPassword)) {
                $user = \App\User::find(Auth::id());
                //dd($user);
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Password Updated Successfully','Success');
                Auth::logout();
                return redirect()->route('login');
            } else {
                Toastr::error('New password cannot be the same as old password.', 'Error');
                return redirect()->back();
            }
        } else {
            Toastr::error('Current password not match.', 'Error');
            return redirect()->back();
        }

    }
}
