<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\UserInfo;
use App\VendorDetails;
use Brian2694\Toastr\Facades\Toastr;
//use Illuminate\Foundation\Auth\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Session;
use Kreait\Laravel\Firebase\Facades\Firebase;

//use Kreait\Firebase\Factory;
//require __DIR__.'/vendor/autoload.php';



class VendorRegController extends Controller
{
    public function vendorLoginForm()
    {
        return view('auth.vendor.vendor_login_form');
    }


    public function vendorLogin(Request $request){
        $credential = [
            'mobile_number' => $request->mobile_number,
            'password' => $request->password,
            'status' => 1,
        ];

        $privateKey = "-----BEGIN PRIVATE KEY-----\nMIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQDWnOBfWljPRqyy\ne5bqj3FL9gW5kBe5lniyfD/mvFnv/DKncYLitMitI7YsIvx0H4VGW1Rllxo5UnXR\nzmLEfZAUanDpmlHS9bUAsi/lR75ClGW2kl/A23bB2b4ICHf0aV6gD+EIB9YLQexg\nc4YXJdmttbuFCv4/CXHzRHmLdF5wWeAeWsaG1+LVLmDdgko4JzGSiIsfe7jg3Asc\nAs7vG5c0TS4dOMD4r7tT30C4TAZWshBEYWUR58eyZaKXbc4ab31f4lKLcbngHCIc\nbawgRJadqbhKBL2FWm35/KL+XWy4FgHhY6pjgWFzTNtMw+j306B+0IpaQNf/mks8\nyTxskX3nAgMBAAECggEABElb3euzDGjP+DyptgOpcqf2U0+Cec18mawLprMqZLW3\n2UpWH+sWewbUk6sbOcKLae1XETRkbLKt8cPaiywq3Y2GtdPEQJ9xvxLQDBdTwIaw\nRWZFDVgU1ihgOE7a/oHARxgqGXv2lYD6lK6aBgpWf7a6iRzAGUg6A27hspxfaoUH\nqGzFCzAJeqdcDIsSXHEZW+k1+x9us5aC2J9lB4wyuaqIqktFjPJCdswPx9xsLr2X\nZn6SPYiTGRTgZnew1Yk/zsvjCaT8lsZja6auq7IclkCj//n5EnLmhtaD20V37eaV\n1JEAnNo1F1VE66JLf6nMPY+WauRESAjVHZFPqAY7EQKBgQD5KRoihM/aZXEx0x6P\n6Y9Wv7gk8cGL23Pb1snrDKFtmXdeXfbH+sz8mOgq9Y1Q95eHPpNpG4XvARC7FQoU\nBU0fkVk3mXmY2TwxLMObJJzq4zOQCAGIZ0GrKfYh94PgqZ5FFiaPVQ2edVCEOE3Y\nK54zzkdC6a0sTWp1Eex6EPlv2QKBgQDcgQA07tmNe+VVZCHW9IqYU/lLUgWzLXUB\n30iajrqln0hZqDFhL/0RDcifQs2QLnN928NHoJBEttAExwQ66xIRIn6Ts/gVVt3y\nfjbQLPsfoTBKKoyu3+k+EoLACrKW76mpAwI0UDLYAgWtiljmXguXcvcxcTmsz3/9\nmBofxjODvwKBgQDM/LHRwG65AUh1c3nrcH5LIoQ/cN6JT80sCrQou0V8RAxfCPNl\nZ8OJ9crcvRS8jlaOID9q9AfmsHuxTwfxnMLsu8oo4g2WYPMSif+L/j1TSgU79Do+\nnKT8SxOCsn4/MY1SzXx/47vGqEHL5f61YH1Rpd4fAN1GW5LAKjTh4GE3UQKBgQCI\nNF8OU2Oq05crkfidMNzTjzt0XSwMK84U4/mTDwsX9zXXu98Uq3HksOD2D2uu3iKU\n4cTUX8f9yfbgnJZuVnoIf4g0cHyTod7jRTdSjBZqyURs66+O7dzDbOe6/GCof04L\nikI4Ujm12DntooGbewgp+ufacJgxuNLUsLmiWunDPQKBgQDIOJQDES/WstOGmTSl\nRxiOxMmkcoxyNrbnTVgRnJJsMTvjo9HzU71ZnGDn5RP2GCK01JaVd/WBZH7HDOLU\nhTSqPnSMX/e2dJkT4IIpUZdhcXaLJDVkf3GDqpEGE2rUv0RTLBnb3MTkDwA/n7rf\nnuvn61fUK/FXONx/h52JZOZgig==\n-----END PRIVATE KEY-----\n";
        if (Auth::attempt($credential)) {
            $payload = array(
                "aud" => "https://identitytoolkit.googleapis.com/google.identity.identitytoolkit.v1.IdentityToolkit",
                "iat" => time(),
                "exp" =>  strtotime(date("Y/m/d H:i:s", strtotime("+30 minutes"))),
                "iss" => "firebase-adminsdk-b71mj@dschat-b633c.iam.gserviceaccount.com",
                "sub" => "firebase-adminsdk-b71mj@dschat-b633c.iam.gserviceaccount.com",
                "uid" => strval(Auth::id()),
            );
//            $firebase_token = JWT::encode($payload, $privateKey, 'RS256');
//            Firebase::auth()->signInWithCustomToken($firebase_token);

//            $docRef = Firebase::firestore()->database()->collection('conversation');
//            dd($docRef);
//            $snapshot = $docRef->snapshot();
//
//            if ($snapshot->exists()) {
//                //printf('Document data:' . PHP_EOL);
//                dd($snapshot->data());
//            } else {
//                dd('Document %s does not exist!');
//            }
            return redirect()->route('vendor.dashboard');
        }else {
            //dd('sdfsadf');
            Toastr::error('Credential Does not matched!!','Error');
            return redirect()->route('vendor.login.form');
        }
    }

    public function vendor_reg()
    {
        return view('auth.vendor.vendor_auth');
    }
    public function vendor_reg_store(Request $request)
    {

        $this->validate($request, [
            'name' =>  'required',
            'mobile_number' => 'required|regex:/(01)[0-9]{9}/|unique:users',
            'email' =>  'required|email|unique:users,email',
            'password' =>  'required|min:6',
        ]);

        $vendorReg = new User();
        $vendorReg->name = $request->name;
        $vendorReg->email = $request->email;
        $vendorReg->mobile_number = $request->mobile_number;
        $vendorReg->password = Hash::make($request->password);
        $vendorReg->role_id = 2;
        $vendorReg->status = 0;
        $vendorReg->save();

        $vendorReg->id;
        $vendorDetails = new VendorDetails();
        $vendorDetails->user_id = $vendorReg->id;
        $vendorDetails->status = 0;
        $vendorDetails->vendor_company_name=$request->name;
        $vendorDetails->account_category = $request->account_category;
        $vendorDetails->save();


        Session::put('phone',$request->mobile_number);
        Session::put('role_id',2);
        Session::put('password',$request->password);
        return redirect()->route('get-verification-code',$vendorReg->id);

//        Toastr::success('Your registration successfully done!');
//
//        $credential = [
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => $request->password,
//        ];
//        if (Auth::attempt($credential)) {
//            return redirect()->route('vendor.dashboard');
//        }
    }

    public function AdminLogin(Request $request){
        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($credential)) {
            Toastr::success('Successfully Logged In!');
            return redirect()->route('vendor.dashboard');
        }else {
            //dd('sdfsadf');
            Toastr::Error('Credential Does not matched!!','Error');
            return redirect()->route('admin.login');
        }
    }

    public function forgetPassForm()
    {
        return view('auth.vendor.forget_pass');
    }

    public function otpForm()
    {
        return view('auth.vendor.otp');
    }

    public function forgetPassCheck(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required|regex:/(01)[0-9]{9}/',
        ]);
        $user = User::where('mobile_number', $request->phone_number)->first();
        if (!empty($user)) {
            $forgetOtp = mt_rand(1111,9999);
            Session::put('forget_otp',$forgetOtp);
            Session::put('mobile_number',$user->mobile_number);
            $text = "Dear ".$user->name.", Your Door Service Forget OTP is ".$forgetOtp;
            UserInfo::smsAPI("88".$user->mobile_number,$text);
            Toastr::success('We send a verification code in your mobile number. please verify your phone number.' ,'Success');
            return view('auth.vendor.forget_pass_otp');
        }else {
            Toastr::warning("Your Enter Mobile Number Does Not Exist In Our System");
            return redirect()->back();
        }
    }
    public function forgetPassVerifyForm()
    {
        return view('auth.vendor.new_pass');
    }

    public function forgetPassVerify(Request $request)
    {
        $forget_code = $request->forget_code;
        $sessionOtp = Session::get('forget_otp');
        if ($forget_code == $sessionOtp) {
            return view('auth.vendor.new_pass');
        }else {
            Toastr::warning('Your Entered Verification code is not valid, please enter valid code.');
        }
    }
    public function newPassStore(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::where('mobile_number', Session::get('mobile_number'))->first();
        $user->password = Hash::make($request->password);
        $user->save();
        Session::forget('mobile_number');
        Session::forget('forget_otp');
        Toastr::success('Successfully Password Changed!', 'Success');
        return redirect()->route('vendor.login');
    }
    public function byPassLogin(Request $request)
    {
       // dd($request->all());
        $credentials = [
            'mobile_number'=> $request->mobile_number,
            'password' => decrypt($request->password),
        ];
        if (Auth::guard('web')->attempt($credentials,true)) {
            //dd(Auth::user());
            return redirect('vendor/dashboard');
        }
    }

    public function baVendor(Request $request)
    {

        $credentials = [
            'mobile_number'=> $request->mobile_number,
            'password' => decrypt($request->password),
        ];
        //dd(decrypt($request->password));
        if (Auth::guard('web')->attempt($credentials,true)) {

           $user = User::find(Auth::id());
           $user->role_id = 2;
           $user->save();

           $vendor = new VendorDetails();
           $vendor->user_id = Auth::id();
           $vendor->status = 1;
           $vendor->vendor_company_name= $user->name;
           $vendor->account_category = 'company';
           $vendor->save();
           return response()->json(['response' => true], 200);
        }
    }
 public function SwitvhToVendor(Request $request)
    {

        $credentials = [
            'mobile_number'=> $request->mobile_number,
            'password' => decrypt($request->password),
        ];
        //dd(decrypt($request->password));
        if (Auth::guard('web')->attempt($credentials,true)) {

           $user = User::find(Auth::id());
           $user->role_id = 2;
           $user->save();
           return response()->json(['response' => true], 200);
        }
    }
    public function VendorSwitchToUser()
    {
        $user = \App\User::find(Auth::id());
        if ($user->role_id == 2) {
            $user->role_id = 3;
            $user->save();
        }
        Auth::logout();
        return redirect('/signin');
    }

}


