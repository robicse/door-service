<?php
/**
 * Created by PhpStorm.
 * User: ashiq
 * Date: 11/11/2019
 * Time: 3:08 PM
 */

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Auth;

use Session;
use Carbon\Carbon;
// use App\Helpers\UserInfo;
use Intervention\Image\ImageManagerStatic as Image;

class UserInfo
{
    public function __construct()
    {

    }


    public static function smsAPI($receiver_number, $sms_text)
    {
       // dd($receiver_number);
        //dd("https://71bulksms.com/sms_api/bulk_sms_sender.php?api_key=16630227328497042020/04/0406:34:27amPriyojon&sender_id=188&message=[".$sms_text."]&mobile_no=[".$receiver_number."]&User_Email=info@priyojon.com");
//        $api = "https://api.mobireach.com.bd/SendTextMessage?Username=taxman&Password=Abcd@2020&From=TaxManBD&To=".$receiver_number."&Message=". urlencode($sms_text);
       $api ="http://isms.zaman-it.com/smsapi?api_key=C2001118615978b3b5b880.40771009&type=text&contacts=".$receiver_number."&senderid=8809612441392&msg=".urlencode($sms_text);
        //http://portal.metrotel.com.bd/smsapi?api_key=C2001118615978b3b5b880.40771009&type=text&contacts=8801723144515&senderid=8809612441392&msg=(Message%20Content)
        //$api = "https://71bulksms.com/sms_api/bulk_sms_sender.php?api_key=16630227328497042020/04/0406:34:27amPriyojon&sender_id=188&message=".urlencode($sms_text)."&mobile_no=".$receiver_number."&User_Email=info@priyojon.com";
        //dd($api);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ=="
            ),
        ));
        //dd($curl);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }
    public static function bypassLogin()
    {
        $data1 = json_encode(array(
            'mobile_number' => '01916050960',
            'password' => '123456',
            '_token' => csrf_token(),
        ));
       /* $data1 = [
            'mobile_number' => '01916050960',
            'password' => '123456',
            '_token' => csrf_token(),
        ];*/
        $api = route('vendor.login');
        //dd($api);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "post",
            CURLOPT_POSTFIELDS => json_encode($data1),
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ=="
            ),
        ));
        //dd($curl);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            $credential = [
                'mobile_number' => '01916050960',
                'password' => '123456',
                'role_id' => 2,
            ];
            if (Auth::attempt($credential)) {
                //dd($password);
                return redirect()->route('vendor.dashboard');
            }
            dd(Auth::user());
            return $response;
        }






        /* $client = new GuzzleHttp\Client();

         $response = $client->request('POST', 'http://demo-enterprise.test/vendor-login', [
             'form_params' => [
                 'mobile_number' => '01916050960',
                 'password' => '123456',

             ]
         ]);*/

       /* $credential = [
            'mobile_number' => $mobile_number,
            'password' => $password,
            'role_id' => 2,
        ];
        if (Auth::attempt($credential)) {
            dd($password);
            return redirect()->route('vendor.dashboard');
        }*/
    }


}
