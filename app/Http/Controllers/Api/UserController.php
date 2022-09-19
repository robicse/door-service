<?php
namespace App\Http\Controllers\API;
use App\Coupon;
use App\Helpers\UserInfo;
use App\Http\Resources\LoginCollections;
use App\Http\Resources\RegistrationCollections;
use App\Order;
use App\OrderCommission;
use App\OrderDetails;
use App\OrderVendor;
use App\Password_Reset_Code;
use App\Review;
use App\User;
use App\VendorDetails;
use App\VendorOrderStatus;
use App\VerificationCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use \Firebase\JWT\JWT;
use Intervention\Image\Facades\Image;



class UserController extends Controller
{

    public $successStatus = 200;
    public $failStatus = 401;

    public function login(Request $request)
    {
        //dd($request->all());
        $user = User::where('mobile_number', $request->phone)->first();
        //dd($user);
        if (!empty($user)){
            //return response()->json(['response' => $user], $this-> successStatus);
            if ($user->role_id == 2){
                $success['user'] = $user;
                $success['user']['key'] = encrypt($request->password);
                $success['type'] = 'vendor';

                return response()->json(['response' => $success], $this-> successStatus);


            }elseif ($user->role_id == 3){
                $privateKey = "-----BEGIN PRIVATE KEY-----\nMIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQDWnOBfWljPRqyy\ne5bqj3FL9gW5kBe5lniyfD/mvFnv/DKncYLitMitI7YsIvx0H4VGW1Rllxo5UnXR\nzmLEfZAUanDpmlHS9bUAsi/lR75ClGW2kl/A23bB2b4ICHf0aV6gD+EIB9YLQexg\nc4YXJdmttbuFCv4/CXHzRHmLdF5wWeAeWsaG1+LVLmDdgko4JzGSiIsfe7jg3Asc\nAs7vG5c0TS4dOMD4r7tT30C4TAZWshBEYWUR58eyZaKXbc4ab31f4lKLcbngHCIc\nbawgRJadqbhKBL2FWm35/KL+XWy4FgHhY6pjgWFzTNtMw+j306B+0IpaQNf/mks8\nyTxskX3nAgMBAAECggEABElb3euzDGjP+DyptgOpcqf2U0+Cec18mawLprMqZLW3\n2UpWH+sWewbUk6sbOcKLae1XETRkbLKt8cPaiywq3Y2GtdPEQJ9xvxLQDBdTwIaw\nRWZFDVgU1ihgOE7a/oHARxgqGXv2lYD6lK6aBgpWf7a6iRzAGUg6A27hspxfaoUH\nqGzFCzAJeqdcDIsSXHEZW+k1+x9us5aC2J9lB4wyuaqIqktFjPJCdswPx9xsLr2X\nZn6SPYiTGRTgZnew1Yk/zsvjCaT8lsZja6auq7IclkCj//n5EnLmhtaD20V37eaV\n1JEAnNo1F1VE66JLf6nMPY+WauRESAjVHZFPqAY7EQKBgQD5KRoihM/aZXEx0x6P\n6Y9Wv7gk8cGL23Pb1snrDKFtmXdeXfbH+sz8mOgq9Y1Q95eHPpNpG4XvARC7FQoU\nBU0fkVk3mXmY2TwxLMObJJzq4zOQCAGIZ0GrKfYh94PgqZ5FFiaPVQ2edVCEOE3Y\nK54zzkdC6a0sTWp1Eex6EPlv2QKBgQDcgQA07tmNe+VVZCHW9IqYU/lLUgWzLXUB\n30iajrqln0hZqDFhL/0RDcifQs2QLnN928NHoJBEttAExwQ66xIRIn6Ts/gVVt3y\nfjbQLPsfoTBKKoyu3+k+EoLACrKW76mpAwI0UDLYAgWtiljmXguXcvcxcTmsz3/9\nmBofxjODvwKBgQDM/LHRwG65AUh1c3nrcH5LIoQ/cN6JT80sCrQou0V8RAxfCPNl\nZ8OJ9crcvRS8jlaOID9q9AfmsHuxTwfxnMLsu8oo4g2WYPMSif+L/j1TSgU79Do+\nnKT8SxOCsn4/MY1SzXx/47vGqEHL5f61YH1Rpd4fAN1GW5LAKjTh4GE3UQKBgQCI\nNF8OU2Oq05crkfidMNzTjzt0XSwMK84U4/mTDwsX9zXXu98Uq3HksOD2D2uu3iKU\n4cTUX8f9yfbgnJZuVnoIf4g0cHyTod7jRTdSjBZqyURs66+O7dzDbOe6/GCof04L\nikI4Ujm12DntooGbewgp+ufacJgxuNLUsLmiWunDPQKBgQDIOJQDES/WstOGmTSl\nRxiOxMmkcoxyNrbnTVgRnJJsMTvjo9HzU71ZnGDn5RP2GCK01JaVd/WBZH7HDOLU\nhTSqPnSMX/e2dJkT4IIpUZdhcXaLJDVkf3GDqpEGE2rUv0RTLBnb3MTkDwA/n7rf\nnuvn61fUK/FXONx/h52JZOZgig==\n-----END PRIVATE KEY-----\n";

                $credentials = [
                    'mobile_number' => $request->phone,
                    'password' => $request->password,
                    'role_id' => 3,
                ];

                if(Auth::attempt($credentials))
                {
                    $user = Auth::user();
                    $vendor = VendorDetails::where('user_id',$user->id)->first();
                    $success['token'] =  $user->createToken('Doorservice')-> accessToken;
                    $success['user'] =  $user;
                    $success['user']['key'] = encrypt($request->password);
                    $success['user']['isVendor'] =  !empty($vendor) ? true : false ;
                    //$success['isVendor'] = !empty($vendor);
                    $payload = array(
                        "aud" => "https://identitytoolkit.googleapis.com/google.identity.identitytoolkit.v1.IdentityToolkit",
                        "iat" => time(),
                        "exp" =>  strtotime(date("Y/m/d H:i:s", strtotime("+30 minutes"))),
                        "iss" => "firebase-adminsdk-b71mj@dschat-b633c.iam.gserviceaccount.com",
                        "sub" => "firebase-adminsdk-b71mj@dschat-b633c.iam.gserviceaccount.com",
                        "uid" => strval(Auth::id()),
                    );
                    $firebase_token = JWT::encode($payload, $privateKey, 'RS256');
                    $success['firebase_token'] =$firebase_token;
                    $success['type'] = 'user';
                    $vendor = VendorDetails::where('user_id',$user->id)->first();
                    $success['user']['isVendor'] =  !empty($vendor) ? true : false ;

                    return response()->json(['response' => $success], $this-> successStatus);
                }else{
                    return response()->json(['response'=>'Unauthorised'], 401);
                }
            }else{

                return 'sssss';
            }
        }

    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'email' => 'required|email|unique:users',
            'phone' => 'required|min:10|numeric',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['response'=>$validator->errors()], $this-> failStatus);
        }
        $phn1 = $request->phone;
        $check = User::where('mobile_number',$phn1)->first();
        if (!empty($check)){
            return response()->json(['response' => 'Phone Number Already Exist'], $this-> failStatus);
        }

        $slug = Str::slug($request->name,'-');
//        $drSlugCheck = User::where('slug', $slug)->first();
//        if(!empty($drSlugCheck)) {
//            $slug = $slug . '-' . Str::random(6);
//        }
        $user = new User();
        $user->name = $request->name;
//        $user->slug = $slug;
        $user->role_id = 3;
        $user->email = $request->name."user@doorservice.net";
        $user->mobile_number = $phn1;
        $user->status = 0;
        $user->password = Hash::make($request->password);

//        $user->sign_up_type = $request->sign_up_type;
        $user->save();

        $verification = VerificationCode::where('phone',$user->mobile_number)->first();
        if (!empty($verification)){
            $verification->delete();
        }
        $verCode = new VerificationCode();
        $verCode->phone = $user->mobile_number;
        $verCode->code = mt_rand(1111,9999);
        $verCode->status = 0;
        $verCode->save();
        $text = "<#> Dear ".$user->name.", Your Door Service OTP is: ".$verCode->code;
        UserInfo::smsAPI($verCode->phone,$text);

//        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['user'] = $user;
//        $success['user']['key'] = encrypt($request->password);
//        $success['user']['isVendor'] = false;
//        session_start();
//        $_SESSION["key"] = encrypt($request->password);

        return response()->json(['response'=>$success], $this-> successStatus);
    }
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }
    public function otp(Request $request)
    {
        //dd($request->all());
        $check = VerificationCode::where('code',$request->code)->where('phone',$request->phone)->where('status',0)->first();
        if (!empty($check)) {
            $check->status = 1;
            $check->update();
            $user = User::where('mobile_number',$request->phone)->first();
            $user->status = 1;
            $user->save();
            $success['user'] =  $user;
            $success['verify'] =  true;
            $success['message'] =  "Verification Succesull";

            //$text = "Dear ".$user->name.", Your account created successfully.";
            //UserInfo::smsAPI($request->phone,$text);

            return response()->json(['success'=>$success], $this-> successStatus);

        }else{
            $check_already_verified_exists = VerificationCode::where('code',$request->code)->where('phone',$request->phone)->where('status',1)->first();
            if(!empty($check_already_verified_exists)){
                $user = User::where('mobile_number',$request->phone)->first();
                $success['user'] =  $user;
                $success['verify'] =  true;
                $success['message'] =  "Already Verified!";
                return response()->json(['success'=>$success], $this-> successStatus);
            }

            $success['verify'] =  false;
            $success['message'] =  "Verification Failed";
            return response()->json(['success'=>$success], $this-> failStatus);
        }
    }
    public function otpResend(Request $request)
    {
        //dd($request->all());
        $check = VerificationCode::where('phone',$request->phone)->first();
        if (!empty($check)) {
            $check->status = 0;
            $check->code = mt_rand(1111,9999);
            $check->save();

            $user = User::where('mobile_number',$request->phone)->first();
            $success['user'] =  $user;
            $success['verify'] =  true;
            $success['message'] =  "Resend OTP Success.";

            $text = "Dear ".$user->name.", Your resend OTP: ".$check->code;
            UserInfo::smsAPI($request->phone,$text);

            return response()->json(['success'=>$success], $this-> successStatus);

        }
    }
    public function getotpCode(Request $request)
    {
        $code = VerificationCode::where('phone',$request->phone)->first();
        if (!empty($code)) {
            return response()->json(['code'=>$code], $this-> successStatus);
        }else{
            return response()->json(['error'=>'Code Failed'], $this-> failStatus);
        }
    }

    public function pro_pic(Request $request)
    {
        $user=User::find(Auth::id());
        $base64_image_propic = $request->pro_img;

        $data = $request->pro_img;
        $pos  = strpos($data, ';');
        $type = explode(':', substr($data, 0, $pos))[1];
        $type1 = explode('/', $type)[1];

        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image_propic)) {
            $data = substr($base64_image_propic, strpos($base64_image_propic, ',') + 1);
            $data = base64_decode($data);

            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . 'UserProPic.'.$type1 ;
            Storage::disk('public')->put("uploads/profile/". $imagename, $data);
            $user->image = $imagename;
            $user->update();

            $success['token'] =  $user->createToken('Doorservice')-> accessToken;
            $success['user'] =  $user;
            return response()->json(['response' => $success], $this-> successStatus);

        }else{
            return response()->json(['response'=>'failed'], $this-> failStatus);
        }

    }

    public function profile_edit(Request $request)
    {
        //$request->all();
//            $this->validate($request,[
//            'full_name' => 'required',
//            'address' => 'required',
//            'city_state' => 'required',
//            'blood_group' => 'required',
//        ]);
//        $slug = Str::slug($request->name,'-');
//        $drSlugCheck = User::where('slug', $slug)->first();
//        if(!empty($drSlugCheck)) {
//            $slug = $slug.'-'.Str::random(6);
//        }
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;

        if(strlen($request->oldPass)==0 && strlen($request->newPass)==0){

        }
        elseif(strlen($request->oldPass)>5 && strlen($request->newPass)>5){
            $hashedPassword = Auth::user()->password;
            if (Hash::check($request->oldPass, $hashedPassword))
            {
                if (!Hash::check($request->newPass,$hashedPassword))
                {
                    $user->password = Hash::make($request->newPass);
                }else{
                    return response()->json(['response'=>'New Password can not be same as old password'], $this-> failStatus);
                }
            }else{
                return response()->json(['response'=>'Old password does not match'], $this-> failStatus);
            }
        }else{
            return response()->json(['response'=>'Minimum Password length 6'], $this-> failStatus);
        }


//        $image = $request->file('pro_img');
//        if (isset($image)) {
//            //make unique name for image
//            $currentDate = Carbon::now()->toDateString();
//            //delete old image.....
//            if(Storage::disk('public')->exists('uploads/profile/'.$user->image))
//            {
//                Storage::disk('public')->delete('uploads/profile/'.$user->image);
//            }
//            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
////            resize image for category and upload
//            $proImage = Image::make($image)->resize(255, 255)->save($image->getClientOriginalExtension());
//            /* insert watermark at bottom-right corner with 10px offset */
//            $proImage->insert(public_path('/uploads/profile/logo.png'), 'bottom-right', 10, 10);
//            //Storage::disk('public')->put('uploads/profile/' . $imagename, $proImage);
//            $proImage->save(public_path('uploads/profile/'.$imagename));
//        } else {
//            $imagename = $user->image;
//        }
//        $user->image = $imagename;
        $user->update();
        $success['token'] =  $user->createToken('Doorservice')-> accessToken;
        $success['user'] =  $user;
        return response()->json(['response' => $success], $this-> successStatus);
    }
    public function uniq_order($id)
    {
        if(empty(Order::where('invoice_code',$id)->first())){
            return true;
        }else{
            return false;
        }
    }
    public function uniq_generator()
    {
        return "ds".rand(100000,999999);
    }

    public function order_submit(Request $request)
    {
//        if (empty($request->coupon_code)) {
//            $discount=0;
//        }else{
//            $coupon = Coupon::where('code', $request->coupon_code)->first();
//            if (empty($coupon)) {
//                return response()->json(['success'=>false,'response' =>'invalid coupon'], $this->failStatus);
//            }else{
//                $discount=$coupon->discount($request->subtotal);
//            }
//        }
        //dd($request->all());
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['address'] = $request->service_address;
        $data['lat'] = $request->service_lat;
        $data['lng'] = $request->service_lng;
        $data['service_date'] = $request->service_date;
        $data['service_name'] = $request->service_name;
        $data['service_type'] = $request->service_type;
        $shipping_info = json_encode($data);

        //echo '2';
        //dd($request->all());
        $order = new Order();
        if($this->uniq_order($this->uniq_generator())){
            $order->invoice_code=$this->uniq_generator();
        }else{
            $order->invoice_code=$this->uniq_generator();
        }

        $order->vendor_id = null;
        $order->user_id = Auth::user()->id;
        $order->shipping_address = $shipping_info;
        //$order->payment_type = 'cod';
        $order->payment_status = 0;
        $order->coupon_discount = $request->discount;
//        $order->grand_total = Cart::total()-$discount;
        $order->old_total = 0;
        $order->grand_total = $request->service_price-$request->discount;
        $order->delivery_cost = 0;
        $order->status_id = 2;
        $order->view = 0;
        $order->type = "service";
        $order->save();

        $orderDetails = new OrderDetails();
        $orderDetails->order_id = $order->id;
        $orderDetails->service_id = $request->service_id;
        $orderDetails->service_name = $request->service_name;
        $orderDetails->service_type = $request->service_type;
        $orderDetails->total = $request->service_price;
        $q = json_encode($request->question);
        $a = json_encode($request->answer);
        $orderDetails->question_set=$q;
        $orderDetails->answer_set=$a;
        $orderDetails->save();

//        if($request->service_type=="Fixed"){
        $order = $order->id;
        $lat = $request->service_lat;
        $lng = $request->service_lng;
        $user_id = Auth::user()->id;
        $vendors= VendorDetails::whereBetween('services_latitude',[$lat-0.05,$lat+0.05])
            ->whereBetween('services_longitude',[$lng-0.05,$lng+0.05])
            ->where('status',1)
            ->orderBy('id', 'desc')
            ->limit(3)
            //->limit(1)
            ->get();
        if (empty($vendors)) {
            $vendors= VendorDetails::whereBetween('services_latitude',[$lat-0.10,$lat+0.10])
                ->whereBetween('services_longitude',[$lng-0.10,$lng+0.10])
                ->where('status',1)
                ->orderBy('id', 'desc')
                ->limit(3)
                //->limit(1)
                ->get();
        }
        if(!empty($vendors)){
            foreach($vendors as $vendor){
                if(Auth::id() != $vendor->user_id){
                    $orderVendor = new OrderVendor();
                    $orderVendor->order_id = $order;
                    $orderVendor->vendor_id = $vendor->user_id;
                    $orderVendor->user_id = null;
                    $orderVendor->save();
                }
            }
        }
//        }


//        if ($request->payment_type == 'cod') {
//            return response()->json(['success'=>true,'response' =>$order], $this->successStatus);
//        }else {
//            $ssl_order=Order::find($order->id);
//            $ssl_order->transaction_id=$request->transaction_id;
//            $ssl_order->ssl_status=$request->ssl_status;
//            $ssl_order->amount_after_getaway_fee=$request->amount_after_getaway_fee;
//            $ssl_order->payment_details=$request->payment_details;
//            $ssl_order->update();
//            return response()->json(['success'=>true,'response' =>$order], $this->successStatus);
//        }
        return response()->json(['success'=>true,'response' =>$order], $this->successStatus);
    }

    public function order_again_request_submit(Request $request)
    {
        //dd($request->all());
        $order_id = $request->order_id;

        $orderVendorIds = OrderVendor::select('vendor_id')->where('order_id',$order_id)->get()->toArray();

        if(count($orderVendorIds) > 0){
            $order = Order::find($order_id);
            $shippingInfo = json_decode($order->shipping_address);
            $lat = $shippingInfo->lat;
            $lng = $shippingInfo->lng;

            $vendors= VendorDetails::whereBetween('services_latitude',[$lat-0.05,$lat+0.05])
                ->whereBetween('services_longitude',[$lng-0.05,$lng+0.05])
                ->where('status',1)
                ->whereNotIn('user_id',$orderVendorIds)
                ->orderBy('id', 'desc')
                //->limit(3)
                ->limit(1)
                ->get();

            if (empty($vendors)) {
                $vendors= VendorDetails::whereBetween('services_latitude',[$lat-0.10,$lat+0.10])
                    ->whereBetween('services_longitude',[$lng-0.10,$lng+0.10])
                    ->where('status',1)
                    ->whereNotIn('user_id',$orderVendorIds)
                    ->orderBy('id', 'desc')
                    //->limit(3)
                    ->limit(1)
                    ->get();
            }
            if(!empty($vendors)){
                $flag = false;
                foreach($vendors as $vendor){
                    if(Auth::id() != $vendor->user_id){
                        $orderVendor = new OrderVendor();
                        $orderVendor->order_id = $order_id;
                        $orderVendor->vendor_id = $vendor->user_id;
                        $orderVendor->user_id = null;
                        $orderVendor->save();
                        if($orderVendor->id){
                            $flag = true;
                        }
                    }
                }
                if($flag === true){
                    return response()->json(['success'=>true,'response' =>'Successfully Again Inserted!'], $this->successStatus);
                }
            }else{
                return response()->json(['success'=>true,'response' =>'No Vendor Found!'], 409);
            }
        }else{
            return response()->json(['success'=>true,'response' =>'No Order Vendor Found!'], 409);
        }
    }

    public function order_all_vendor_request_count(Request $request)
    {
        //dd($request->all());
        $order_id = $request->order_id;
        $orderVendorCount = OrderVendor::where('order_id',$order_id)->get()->count();
        return response()->json(['success'=>true,'response' =>$orderVendorCount], $this->successStatus);
    }
    public function order_get_all()
    {
        $orders=Order::where('user_id',Auth::id())->latest()->get();
        foreach ($orders as $order){
            $order->shipping_address=json_decode($order->shipping_address);
        }
        return response()->json(['success'=>true,'response' =>$orders], $this->successStatus);
    }
    public function order_details(Request $request)
    {
        $order=Order::where('invoice_code',$request->order_invoice_id)->first();
        if(empty($order)){
            return response()->json(['success'=>false,'response' =>[]], $this->successStatus);
        }

        $order_details_single=OrderDetails::where('order_id',$order->id)->first();
        $order_details_single->question_set=json_decode($order_details_single->question_set);
        $order_details_single->answer_set=json_decode($order_details_single->answer_set);

        if($order->vendor_id==null){
            $vendor=null;
            $order_status=null;
            $quoted_vendor=DB::table('orders')
                ->join('order_vendors', 'order_vendors.order_id', '=', 'orders.id')
                ->join('users', 'order_vendors.vendor_id', '=', 'users.id')
                ->where('orders.id','=',$order->id)
                ->where('order_vendors.user_id','=',Auth::id())
                ->select('users.id','users.name','users.image','order_vendors.id as order_vendor_id')
                ->get();
            if(count($quoted_vendor)==0) {
                $quoted_vendor = [];
            }

        }else{
            $vendor = DB::table('users')
                ->join('vendor_details', 'vendor_details.user_id', '=', 'users.id')
                ->where('users.id','=',$order->vendor_id)
                ->get();
            $order_status=DB::table('statuses')
                ->join('vendor_order_statuses', 'vendor_order_statuses.status_id', '=', 'statuses.id')
                ->where('vendor_order_statuses.order_id',$order->id)
                ->select('statuses.name','vendor_order_statuses.created_at')
                ->get();
            $quoted_vendor = [];
            //$vendor=VendorDetails::find($order->vendor_id);
        }

        $order->shipping_address=json_decode($order->shipping_address);
        $order_details=[];
        $order_details[0]=$order_details_single;
        $order_details[1]=$vendor;
        $order_details[2]=$order;
        $order_details[3]=$quoted_vendor;
        $order_details[4]=$order_status;

        return response()->json(['success'=>true,'response' =>$order_details], $this->successStatus);
    }
    public function grand_total_change(Request $request){
        $order = Order::find($request->order_id);
        $order->grand_total = $request->grand_total;
        $order->save();
        return response()->json(['success'=>true,'response' =>$order], $this->successStatus);
    }
    public function order_vendor(Request $request)
    {
        $vendorOrder=OrderVendor::find($request->id);
        if(empty($vendorOrder)){
            return response()->json(['success'=>false,'response' =>[]], $this->successStatus);
        }
        $vendor = DB::table('users')
            ->join('vendor_details', 'vendor_details.user_id', '=', 'users.id')
            ->where('users.id','=',$vendorOrder->vendor_id)
            ->get();
        $order=Order::find($vendorOrder->order_id);

        $order_vendor=[];
        $order_vendor[0]=$vendorOrder;
        $order_vendor[1]=$vendor;
        $order_vendor[2]=$order;
        $order_vendor[3]=Auth::user();

        return response()->json(['success'=>true,'response' =>$order_vendor], $this->successStatus);

    }
    public function book_order(Request $request){
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'vendor_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['response'=>$validator->errors()], $this-> failStatus);
        }

        //dd($request->all());
        $order = Order::find($request->order_id);
        $order->vendor_id = $request->vendor_id;
        $order->payment_process = $request->payment_process;
        $order->status_id = 1;
        $order->save();

        // active
        $orderVendor = OrderVendor::where('order_id',$request->order_id)
            ->where('vendor_id',$request->vendor_id)
            ->first();
        $orderVendor->book_status=1;
        $orderVendor->order_detail_communication=$request->order_detail_communication;
        $orderVendor->save();

        // disable
        $orderVendors = OrderVendor::where('order_id',$request->order_id)
            ->where('vendor_id','!=',$request->vendor_id)
            ->get();
        if(count($orderVendors) > 0){
            foreach ($orderVendors as $orderVendor){
                $orderVen = OrderVendor::find($orderVendor->id);
                $orderVen->book_status=0;
                $orderVen->save();
            }
        }

        $vendorOrderStatus = new VendorOrderStatus();
        $vendorOrderStatus->user_id = $order->vendor_id;
        $vendorOrderStatus->order_id = $order->id;
        $vendorOrderStatus->status_id = 1;
        $vendorOrderStatus->save();

        if($order->payment_status==1){
            $commission = OrderCommission::first();
            $commissionValue = $order->grand_total*$commission->commission_percentage / 100;
            if($request->payment_process=="authorized"){
                // authorized
                DB::table('payment_histories')->insert([
                    'order_id' => $order->id,
                    'payment_type' => 'ssl',
                    'vendor_amount'=>$order->grand_total - $commissionValue,
                    'admin_amount'=>$commissionValue,
                ]);

//                $order = Order::find($order->id);
//                $order->vendor_id = $request->vendor_id;
//                $order->save();
            }else{
                // unauthorized
                DB::table('payment_histories')->insert([
                    'order_id' => $order->id,
                    'payment_type' => 'ssl',
                    //'vendor_amount'=>$order->grand_total - $commissionValue,
                    //'admin_amount'=>$commissionValue,
                    'vendor_amount'=>$order->grand_total,
                    'admin_amount'=>0,
                ]);
            }
        }

        return response()->json(['success'=>true,'response' =>$order], $this->successStatus);
    }
    public function reviewStore(Request $request){
        $order = Order::find($request->order_id);
        if ($order->vendor_id !=null){
            $getReview = Review::where('order_id',$request->order_id)->where('user_id',Auth::id())->where('vendor_user_id',$order->vendor_id)->first();
            if (empty($getReview)){
                $review = new Review();
                $review->order_id = $request->order_id;
                $review->user_id = Auth::id();
                $review->vendor_user_id = $order->vendor_id;
                if ($request->rating >= 1 && $request->rating<=5 ){
                    $review->rating = $request->rating;
                }else{
                    return response()->json(['success'=>false,'response' =>'Invalid Rating'], $this->failStatus);
                }
                $review->comment = $request->comment;
                $review->save();
                return response()->json(['success'=>true,'response' =>$review], $this->successStatus);
            }else{
                return response()->json(['success'=>false,'response' =>'You have already reviewed this order!'], $this->failStatus);
            }
        }else{
            return response()->json(['success'=>false,'response' =>'You need to book the order first'], $this->failStatus);
        }
    }
    public function coupon(Request $request)
    {
        //dd($request->all());
        if (empty($request->coupon_code)) {
            return response()->json(['success'=>true,'response' =>0,'maseg'=>"Inavlid Coupon"], $this->successStatus);
        }else{
            $coupon = Coupon::where('code', $request->coupon_code)->where('status', 1)->first();
            if (empty($coupon)) {
                return response()->json(['success'=>true,'response' =>0,'maseg'=>"Inavlid Coupon"], $this->successStatus);
            }else{
                if($coupon->min_spent<=$request->subtotal){
                    $discount=$coupon->discount($request->subtotal);
                    return response()->json(['success'=>true,'response' => $discount,'maseg'=>"Coupon Applied"], $this->successStatus);
                }else{
                    $minimum="Minimum order value for this promo code, ".$coupon->min_spent." TK, has not been reached.";
                    return response()->json(['success'=>true,'response' => 0,'maseg'=>$minimum], $this->successStatus);
                }
            }

        }
    }

    public function user_appointment(Request $request)
    {
//        $user_app = DB::table('doctors')
//            ->join('users', 'doctors.user_id', '=', 'users.id')
//            ->join('departments', 'doctors.department_id', '=', 'departments.id')
//             ->join('doctor_schedule_time_slots', 'doctors.id', '=', 'doctor_schedule_time_slots.doctor_id')
//            ->select('users.id as user_id', 'users.name as user_name', 'users.slug as user_slug', 'users.image', 'users.phone', 'users.country_code', 'doctors.id as doctor_id','departments.name as department_name','doctor_schedule_time_slots.date as app_date','doctor_schedule_time_slots.time as app_time','doctor_schedule_time_slots.additional_info as additional_info')
//           ->where('doctor_schedule_time_slots.user_id','=',$request->user_id)
//            ->get();

        $user_app = DB::table('doctors')
            ->join('users', 'doctors.user_id', '=', 'users.id')
            ->join('doctor_schedule_time_slots', 'doctors.id', '=', 'doctor_schedule_time_slots.doctor_id')
            ->join('clinics', 'clinics.id', '=', 'doctor_schedule_time_slots.clinic_id')
            ->select('users.id as user_id', 'users.name as user_name', 'users.slug as user_slug', 'users.image', 'users.phone', 'users.country_code', 'doctors.id as doctor_id','clinics.id as clinic_id','clinics.name as clinic_name','clinics.address as clinic_address','doctor_schedule_time_slots.date as app_date','doctor_schedule_time_slots.time as app_time','doctor_schedule_time_slots.additional_info as additional_info')
            ->where('doctor_schedule_time_slots.user_id','=',$request->user_id)
            ->get();

        return response()->json(['user_app' => $user_app], $this->successStatus);
    }
    public function user_home_appointment(Request $request)
    {
        $user_home_app = DB::table('doctors')
            ->join('users', 'doctors.user_id', '=', 'users.id')
            ->join('doctor_at_home_schedule_time_slots', 'doctors.id', '=', 'doctor_at_home_schedule_time_slots.doctor_id')
            ->select('users.id as user_id', 'users.name as user_name', 'users.slug as user_slug', 'users.image', 'users.phone', 'users.country_code', 'doctors.id as doctor_id','doctor_at_home_schedule_time_slots.date as app_date','doctor_at_home_schedule_time_slots.time as app_time','doctor_at_home_schedule_time_slots.additional_info as additional_info')
            ->where('doctor_at_home_schedule_time_slots.user_id','=',$request->user_id)
            ->get();

        return response()->json(['user_home_app' => $user_home_app], $this->successStatus);
    }

    public function reset_pass_check_mobile(Request $request) {

        $user=\App\User::where('mobile_number',$request->phone)->first();

        if(!empty($user)){

            $verification = \App\Password_Reset_Code ::where('phone',$user->phone)->first();

            if (!empty($verification)){
                $verification->delete();
            }

            $verCode = new Password_Reset_Code();
            $verCode->phone = $request->phone;
            $verCode->code = mt_rand(1111,9999);
            $verCode->status = 0;
            $verCode->save();
            $text = "<#> Dear ".$user->name.", Your Password Reset Verification Code is ".$verCode->code." /bCe8bIGKEiT";
            UserInfo::smsAPI($verCode->phone,$text);
            return response()->json(['status'=>$user], $this->successStatus);

        }else{
            $content="oops!! No User Found With This Phone Number.Please Sign Up First.";
            return response()->json(['status'=>$content], $this->successStatus);
        }
    }

    public function check_verification(Request $request) {
        $verification = \App\Password_Reset_Code::where('phone',$request->phone)->where('code',$request->code)->first();
        if (!empty($verification)){
            //$user=\App\User::where('phone',$request->phone)->first();
            $user=\App\User::where('mobile_number',$request->phone)->first();
            //$rand_pass= $request->new_pass;
            $rand_pass= $request->newPass;
            $new_pass=Hash::make($rand_pass);
            $user->password=$new_pass;
            $user->update();
            $verification->status = 1;
            $verification->update();
            return response()->json(['status'=>'success'], $this->successStatus);
        }else{
            return response()->json(['status'=>'failed'], $this->successStatus);
        }
    }

    public function reset_password(Request $request) {
        $user=User::find(Auth::id());
        if (Hash::check($request->current_password, $user->password))
        {
            $newPass=Hash::make($request->new_password);
            $user->password=$newPass;
            $user->update();
            return response()->json(['status'=>'success'], $this->successStatus);

        }else{
            return response()->json(['status'=>'failed'], $this->failStatus);
        }
//        $userPass=bycrpt($user->password);

    }

    public function web_slide() {
        $slider_home= \App\Slider::where('type','front')->get();
        return response()->json(['success'=>$slider_home], $this->successStatus);
    }
    public function gc_slide() {
        $slider_gc= \App\Slider::where('type','goodkart')->get();
        return response()->json(['success'=>$slider_gc], $this->successStatus);
    }
    public function show_all_bloodDonor(Request $request)
    {
        $donors=User::where('is_donor',1)
            ->where('id','>',$request->last_id)
            ->take($request->limit)
            ->get();
        return response()->json(['success'=>$donors], $this->successStatus);
    }
    public function show_all_bloodDonor_type(Request $request)
    {
        $donors=User::where('is_donor',1)
            ->where('blood_group',$request->blood_type)
            ->where('id','>',$request->last_id)
            ->take($request->limit)
            ->get();
        return response()->json(['success'=>$donors], $this->successStatus);
    }

    public function all_like(Request $request)
    {
        if($request->type=="doctor"){
            $check=\App\User_like::where('doctor_id',$request->doctor_user_id)->where('user_id',Auth::user()->id)->first();
            if($check==NULL){
                $like=new \App\User_like();
                $like->user_id=Auth::user()->id;
                $like->doctor_id=$request->doctor_user_id;
                $like->save();
                $status=true;
            }
            else{
                $check->delete();
                $status=false;
            }
            return response()->json(['status'=>$status], $this->successStatus);
        }
        elseif($request->type=="cg"){
            $check=\App\User_caregiver_like::where('caregiver_id',$request->cg_user_id)->where('user_id',Auth::user()->id)->first();
            if($check==NULL){

                $like=new \App\User_caregiver_like();
                $like->user_id=Auth::user()->id;
                $like->caregiver_id=$request->cg_user_id;
                $like->save();
                $status=true;
            }
            else{
                $check->delete();
                $status=false;
            }
            return response()->json(['status'=>$status], $this->successStatus);
        }
        elseif ($request->type=="question"){
            $check=\App\User_question_like::where('question_id',$request->q_id)->where('user_id',Auth::user()->id)->first();
            if($check==NULL){
                $like=new \App\User_question_like();
                $like->user_id=Auth::user()->id;
                $like->question_id=$request->q_id;
                $like->save();
                $q_like=\App\AskQuestion::find($request->q_id);
                $q_like->question_like=$q_like->question_like+1;
                $q_like->update();
                $status=true;
            }
            else{
                $check->delete();
                $status=false;
                $q_like=\App\AskQuestion::find($request->q_id);
                if($q_like->question_like==0){
                    $q_like->question_like=0;
                }
                else{
                    $q_like->question_like=$q_like->question_like-1;
                }
                $q_like->update();
            }
            return response()->json(['status'=>$status], $this->successStatus);
        }
    }
    public function caregiver_like(Request $request)
    {

        $check=\App\User_caregiver_like::where('caregiver_id',$request->cg_user_id)->where('user_id',Auth::user()->id)->first();
        if($check==NULL){

            $like=new \App\User_caregiver_like();
            $like->user_id=Auth::user()->id;
            $like->caregiver_id=$request->cg_user_id;
            $like->save();
            $status=true;
        }
        else{
            $check->delete();
            $status=false;
        }

        return response()->json(['status'=>$status], $this->successStatus);
    }
    public function question_like(Request $request)
    {

        $check=\App\User_question_like::where('question_id',$request->q_id)->where('user_id',Auth::user()->id)->first();
        if($check==NULL){
            $like=new \App\User_question_like();
            $like->user_id=Auth::user()->id;
            $like->question_id=$request->q_id;
            $like->save();
            $q_like=\App\AskQuestion::find($request->q_id);
            $q_like->question_like=$q_like->question_like+1;
            $q_like->update();
            $status=true;
        }
        else{
            $check->delete();
            $status=false;
            $q_like=\App\AskQuestion::find($request->q_id);
            if($q_like->question_like==0){
                $q_like->question_like=0;
            }
            else{
                $q_like->question_like=$q_like->question_like-1;
            }
            $q_like->update();
        }

        return response()->json(['status'=>$status], $this->successStatus);
    }

    public function check_like(Request $request)
    {
        if($request->type=="doctor"){
            $check=\App\User_like::where('doctor_id',$request->doctor_user_id)->where('user_id',Auth::user()->id)->first();
            if($check==NULL){
                $status=false;
            }
            else{
                $status=true;
            }
            return response()->json(['status'=>$status], $this->successStatus);
        }
        elseif($request->type=="cg"){
            $check=\App\User_caregiver_like::where('caregiver_id',$request->cg_user_id)->where('user_id',Auth::user()->id)->first();
            if($check==NULL){
                $status=false;
            }
            else{
                $status=true;
            }
            return response()->json(['status'=>$status], $this->successStatus);
        }
        elseif ($request->type=="question"){
            $check=\App\User_question_like::where('question_id',$request->q_id)->where('user_id',Auth::user()->id)->first();
            if($check==NULL){
                $status=false;
            }
            else{
                $status=true;
            }
            return response()->json(['status'=>$status], $this->successStatus);
        }
    }
    public function like_list(Request $request)
    {
        $doctors = DB::table('doctors')
            ->join('users', 'doctors.user_id', '=', 'users.id')
            ->join('departments', 'doctors.department_id', '=', 'departments.id')
            ->join('user_likes', 'users.id', '=', 'user_likes.doctor_id')
            ->select('users.id as user_id', 'users.name as user_name', 'users.slug as user_slug', 'users.image', 'users.phone', 'users.country_code','users.gender', 'doctors.id as doctor_id', 'doctors.title', 'doctors.experience', 'doctors.clinic_cost', 'doctors.online_cost', 'doctors.home_cost', 'departments.name as department_name')
            ->where('doctors.is_active', '=', 1)
            ->where('user_likes.user_id', '=', Auth::user()->id)
            ->get();
//DB::table('caregivers')
//            ->join('users', 'caregivers.user_id', '=', 'users.id')
//            ->join('caregiver_department', 'caregivers.department_id', '=', 'caregiver_department.id')
//            ->select('users.id as user_id', 'users.name as user_name', 'users.slug as user_slug', 'users.image', 'users.phone', 'users.country_code', 'caregivers.id as caregiver_id', 'caregivers.gender','caregivers.title', 'caregivers.is_active','caregiver_department.caregiver_department as department_name','caregiver_department.id as department_id')
//            ->where('caregivers.is_active', '=', 1)
        $caregivers = DB::table('caregivers')
            ->join('users', 'caregivers.user_id', '=', 'users.id')
            ->join('caregiver_department', 'caregivers.department_id', '=', 'caregiver_department.id')
            ->join('user_caregiver_like', 'users.id', '=', 'user_caregiver_like.caregiver_id')
            ->select('users.id as user_id', 'users.name as user_name', 'users.slug as user_slug', 'users.image', 'users.phone', 'users.country_code', 'caregivers.id as caregiver_id', 'caregivers.gender','caregivers.schedule_type','caregivers.title', 'caregivers.is_active','caregiver_department.caregiver_department as department_name','caregiver_department.id as department_id')
            ->where('user_caregiver_like.user_id', '=', Auth::user()->id)
            ->get();


        $question = DB::table('ask_questions')
            ->join('answer_by_questions', 'ask_questions.id', '=', 'answer_by_questions.question_id')
            ->join('user_question_like', 'answer_by_questions.id', '=', 'user_question_like.question_id')
            ->join('users', 'users.id', '=', 'ask_questions.answerd_user')
            ->select('ask_questions.*','answer_by_questions.*','ask_questions.id as que_id','users.name','users.image')
            ->where('user_question_like.user_id', '=', Auth::user()->id)
            ->latest('answer_by_questions.created_at')
            ->get();

//            $question=\App\User_question_like::where('user_id',Auth::user()->id)->get();
        return response()->json(['doctors'=>$doctors,'caregivers'=>$caregivers,'question'=>$question], $this->successStatus);
    }
    public function appoint(Request $request)
    {
        $appointmentCaregiver = DB::table('users')
            ->join('caregiver_schedule_time_slots', 'users.id', '=', 'caregiver_schedule_time_slots.caregiver_id')
            ->where('caregiver_schedule_time_slots.user_id', '=', Auth::user()->id)
            ->where('caregiver_schedule_time_slots.schedule_type', '=', $request->schedule_type)
            ->get();

//        $appointmentCaregiver=\App\CaregiverScheduleTimeSlot::where('user_id',Auth::user()->id)->get();
        return response()->json(['cg_appointment'=>$appointmentCaregiver], $this->successStatus);
    }

    public function lat_lng(Request $request)
    {
        $user=User::find(Auth::id());
        $user->lat=$request->lat;
        $user->lng=$request->lng;
        $user->update();
        return response()->json(['lat'=>$user->lat,'lng'=>$user->lng], $this->successStatus);
    }




    public function vendor_average_rating(Request $request) {
        $sumVendorReview = \App\Review::where('vendor_user_id', $request->vendor_id)->select(DB::raw('SUM(rating) as total_rating'),DB::raw('count(id) as total_user'))->first();
        $vendor_average_rating = $sumVendorReview->total_user == 0 ? 0 : ($sumVendorReview->total_rating / $sumVendorReview->total_user);

        return response()->json(['vendor_average_rating'=> (int) $vendor_average_rating], $this->successStatus);
    }




    // app part start

    public function loginApp(Request $request)
    {

        $credentials = [
            'mobile_number' => $request->phone,
            'password' => $request->password,
            //'role_id' => 3,
        ];

        if(Auth::attempt($credentials))
        {
            $user = Auth::user();
            return new LoginCollections(User::where('id', $user->id)->get());
        }else{
            return response()->json(['response'=>'Unauthorised'], 401);
        }


    }

    public function registerApp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|min:10|numeric',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['response'=>$validator->errors()], $this-> failStatus);
        }
        $phn1 = $request->phone;
        $check = User::where('mobile_number',$phn1)->first();
        if (!empty($check)){
            return response()->json(['response' => 'Phone Number Already Exist'], 409);
        }

        $user = new User();
        $user->name = $request->name;
        // user
//        if($request->role_id == 3){
//            $user->role_id = $request->role_id;
//        }
        // vendor
//        if($request->role_id == 2){
//            $user->role_id = $request->role_id;
//            $user->email = $request->email;
//        }
        $user->mobile_number = $phn1;
        $user->status = 0;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();
        $user_id = $user->id;

        if($user_id){
            //vendor details
            if($request->role_id == 2) {
                $vendorDetails = new VendorDetails();
                $vendorDetails->user_id = $user_id;
                $vendorDetails->status = 0;
                $vendorDetails->account_category = 'company';
                $vendorDetails->save();
            }

            $verification = VerificationCode::where('phone',$user->mobile_number)->first();
            if (!empty($verification)){
                $verification->delete();
            }
            $verCode = new VerificationCode();
            $verCode->phone = $user->mobile_number;
            $verCode->code = mt_rand(1111,9999);
            $verCode->status = 0;
            $verCode->save();

            // send sms
            $text = "<#> Dear ".$user->name.", Your Door Service OTP is: ".$verCode->code;
            UserInfo::smsAPI($verCode->phone,$text);

            return new RegistrationCollections(User::where('id', $user_id)->get());
        }else{
            return response()->json(['error'=>'Something Went Wrong!'], $this-> failStatus);
        }


    }

    public function reset_pass_check_mobile_app(Request $request) {

        $user=\App\User::where('mobile_number',$request->phone)->first();

        if(!empty($user)){

            $user->password=Hash::make($request->new_password);
            $user->status = 1;
            $user->save();

            $verification = VerificationCode::where('phone',$request->phone)->where('code',$request->code)->first();
            if(!empty($verification)){
                $verification->status = 1;
                $verification->save();

                $success['user'] =  $user;
                $success['verify'] =  true;
                $success['message'] =  "Password Updated Success";

                return response()->json(['success'=>$success], $this->successStatus);
            }else{
                $success['verify'] =  false;
                $success['message'] =  "OOPS!! No Found Verification Code.Please Try Another!";

                return response()->json(['success'=>$success], $this->successStatus);
            }


        }else{
            $success['verify'] =  false;
            $success['message'] =  "OOPS!! No User Found With This Phone Number.Please Try Another!";

            return response()->json(['success'=>$success], $this->successStatus);
        }
    }

    public function changed_pass_check_mobile_app(Request $request) {

        $credentials = [
            'mobile_number' => $request->phone,
            'password' => $request->current_password,
            //'role_id' => 3,
        ];

        if(Auth::attempt($credentials))
        {
            //$user = Auth::user();
            $user=\App\User::where('mobile_number',$request->phone)->first();
            $user->password = Hash::make($request->new_password);
            $user->save();

            return new LoginCollections(User::where('id', $user->id)->get());
        }else{
            return response()->json(['response'=>'Phone OR Password Is Invalid!'], 401);
        }
    }

    public function SwitchToVendor(Request $request)
    {
        $user=\App\User::where('mobile_number',$request->phone)->first();

        if(!empty($user)){
            $user->role_id = $request->role_id;
            $affected_row = $user->save();

            if($affected_row){
                return new LoginCollections(User::where('id', $user->id)->get());
            }else{
                return response()->json(['response'=>'Unauthorised'], 401);
            }

        }else{
            $success['verify'] =  false;
            $success['message'] =  "OOPS!! No User Found With This Phone Number.Please Try Another!";

            return response()->json(['success'=>$success], $this->successStatus);
        }
    }

    public function order_submit_app(Request $request)
    {
//        if (empty($request->coupon_code)) {
//            $discount=0;
//        }else{
//            $coupon = Coupon::where('code', $request->coupon_code)->first();
//            if (empty($coupon)) {
//                return response()->json(['success'=>false,'response' =>'invalid coupon'], $this->failStatus);
//            }else{
//                $discount=$coupon->discount($request->subtotal);
//            }
//        }
        //dd($request->all());
        //return response()->json(['success'=>true,'response' =>$request->name], $this->successStatus);
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['address'] = $request->service_address;
        $data['lat'] = $request->service_lat;
        $data['lng'] = $request->service_lng;
        $data['service_date'] = $request->service_date;
        $data['service_name'] = $request->service_name;
        $data['service_type'] = $request->service_type;
        $shipping_info = json_encode($data);

        //echo '2';
        //dd($request->all());
        $order = new Order();
        if($this->uniq_order($this->uniq_generator())){
            $order->invoice_code=$this->uniq_generator();
        }else{
            $order->invoice_code=$this->uniq_generator();
        }

        $order->vendor_id = null;
        $order->user_id = Auth::user()->id;
        $order->shipping_address = $shipping_info;
        $order->payment_type = 'cod';
        $order->payment_status = 0;
        $order->coupon_discount = $request->discount;
//        $order->grand_total = Cart::total()-$discount;
        $order->old_total = 0;
        $order->grand_total = $request->service_price-$request->discount;
        $order->delivery_cost = 0;
        $order->status_id = 2;
        $order->view = 0;
        $order->type = "service";
        $order->save();

        $orderDetails = new OrderDetails();
        $orderDetails->order_id = $order->id;
        $orderDetails->service_id = 0;
        $orderDetails->service_name = $request->service_name;
        $orderDetails->service_type = $request->service_type;
        $orderDetails->total = $request->service_price;
        $q = json_encode($request->question);
        $a = json_encode($request->answer);
        $orderDetails->question_set=$q;
        $orderDetails->answer_set=$a;
        $orderDetails->save();

//        if($request->service_type=="Fixed"){
        $order = $order->id;
        $lat = $request->service_lat;
        $lng = $request->service_lng;
        $user_id = Auth::user()->id;
        $vendors= VendorDetails::whereBetween('services_latitude',[$lat-0.05,$lat+0.05])
            ->whereBetween('services_longitude',[$lng-0.05,$lng+0.05])
            ->where('status',1)
            ->orderBy('id', 'desc')
            //->limit(3)
            ->limit(1)
            ->get();
        if (empty($vendors)) {
            $vendors= VendorDetails::whereBetween('services_latitude',[$lat-0.10,$lat+0.10])
                ->whereBetween('services_longitude',[$lng-0.10,$lng+0.10])
                ->where('status',1)
                ->orderBy('id', 'desc')
                ->limit(3)
                //->limit(1)
                ->get();
        }
        if(!empty($vendors)){
            foreach($vendors as $vendor){
                if(Auth::id() != $vendor->user_id){
                    $orderVendor = new OrderVendor();
                    $orderVendor->order_id = $order;
                    $orderVendor->vendor_id = $vendor->user_id;
                    $orderVendor->user_id = null;
                    $orderVendor->save();
                }
            }
        }
//        }


//        if ($request->payment_type == 'cod') {
//            return response()->json(['success'=>true,'response' =>$order], $this->successStatus);
//        }else {
//            $ssl_order=Order::find($order->id);
//            $ssl_order->transaction_id=$request->transaction_id;
//            $ssl_order->ssl_status=$request->ssl_status;
//            $ssl_order->amount_after_getaway_fee=$request->amount_after_getaway_fee;
//            $ssl_order->payment_details=$request->payment_details;
//            $ssl_order->update();
//            return response()->json(['success'=>true,'response' =>$order], $this->successStatus);
//        }
        return response()->json(['success'=>true,'response' =>$order], $this->successStatus);
    }

    //==================== profile image upload =============================//
    public function userImageUpload(Request $request)
    {
        $user = User::find($request->user_id);
        $image = $request->file('image');
        if (isset($image)) {
            $imagename = imageUploadAndUpdate($image, 'uploads/profile/', 0, $user->image);
        } else {
            $imagename = $user->image;
        }
        $user->image = $imagename;
        if ($user->save()) {
            // $userData = new  UserProfileCollections(User::where('id', $user->id)->get());
            return response()->json(['success' => true, 'response' => $user], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'response' => 'No Successfully Updated!'], $this->failStatus);
        }

    }
    public function userFbTokenUpdate(Request $request)
    {
        $user = User::find($request->user_id);
        $user->firebaseToken = $request->firebaseToken;
        if ($user->save()) {
            // $userData = new  UserProfileCollections(User::where('id', $user->id)->get());
            return response()->json(['success' => true, 'response' => $user], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'response' => 'Something went wrong!'], $this->failStatus);
        }
    }

    public function profile_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'email' => 'required|email|unique:users',
            'email'=> 'required|unique:users,email,'.$request->user_id,
        ]);
//        $this->validate($request,[
//            'email'=> 'required|unique:users,email,'.$request->user_id,
//        ]);
        if ($validator->fails()) {
            return response()->json(['response'=>$validator->errors()], 409);
        }

        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $affected_row = $user->update();

        if ($affected_row) {
            // $userData = new  UserProfileCollections(User::where('id', $user->id)->get());
            return response()->json(['success' => true, 'response' => $user], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'response' => 'Something went wrong!'], $this->failStatus);
        }
    }

    public function passwordCheck(Request $request){
        $user = User::find($request->user_id);
        $hashedPassword = $user->password;
            if (Hash::check($request->password, $hashedPassword)){
                return response()->json(['success' => true, 'response' => 'true'], $this->successStatus);
            }else{
                return response()->json(['success' => false, 'response' => 'false'], $this->successStatus);
            }
    }
    // app part end

}
