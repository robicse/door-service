<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\UserInfo;
use App\User;
use App\VerificationCode;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VerificationController extends Controller
{
    public function CheckVerificationCode(Request $request){
        $check = VerificationCode::where('code', $request->code)->where('phone', Session::get('phone'))->where('status', 0)->first();
        //dd($check);
        //$users = User::where('bp_code',$request->bp_code)->pluck('id')->first();
        if(!empty($check)){
            echo 'found';
        }else{
            echo 'not found';
        }
    }

    public function getVerificationCode($id)
    {
        $user = User::find($id);

        $verification = VerificationCode::where('phone',$user->mobile_number)->first();
        if (!empty($verification)){
            $verification->delete();
        }
        $verCode = new VerificationCode();
        $verCode->phone = $user->mobile_number;
        $verCode->code = mt_rand(1111,9999);
        $verCode->status = 0;
        $verCode->save();
        $text = "Dear ".$user->name.", Your Door Service OTP is ".$verCode->code;
//        echo $text;exit();
        UserInfo::smsAPI("88".$verCode->phone,$text);
        Toastr::success('Thank you for your registration. We send a verification code in your mobile number. please verify your phone number.' ,'Success');
        //$verCode = $verCode->phone;
        //dd($text);
        return view('auth.vendor.otp',compact('verCode'));
    }
    public function verification(Request $request){
        //dd($request->all());
        if ($request->isMethod('post')){
            $check = VerificationCode::where('code',$request->code)->where('phone',$request->phone)->where('status',0)->first();
            if (!empty($check)) {
                $check->status = 1;
                $check->update();
                $user = User::where('mobile_number',$request->phone)->first();
                //dd($user);
                $user->status = 1;
                $user->save();
                Toastr::success('Your phone number successfully verified.' ,'Success');
                /*return redirect('login');*/
                $credentials = [
                    'mobile_number' => Session::get('phone'),
                    'password' => Session::get('password'),
                    'role_id' => Session::get('role_id'),
                ];
                if (Auth::attempt($credentials)) {
                    Session::forget('phone');
                    Session::forget('password');
                    if (Session::get('role_id') == 2)
                    {
                        return redirect()->route('vendor.dashboard');
                    }
                }
            }else{
                //$verCode = $request->phone;
                $verCode = VerificationCode::where('phone',$request->phone)->where('status',0)->first();
                Toastr::error('Invalid Code' ,'Error');
                return view('auth.vendor.otp',compact('verCode'));
            }
        }
    }
}
