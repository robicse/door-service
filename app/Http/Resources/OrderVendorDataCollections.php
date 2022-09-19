<?php

namespace App\Http\Resources;

use App\Order;
use App\OrderVendor;
use App\Status;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class OrderVendorDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
//                $order = Order::find($data->order_id);
//                $d_status = Status::find($order->status_id);
//                $shippingInfo = json_decode($order->shipping_address);


                $userInfo = User::find($data->vendor_id);
                    $privateKey = "-----BEGIN PRIVATE KEY-----\nMIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQDWnOBfWljPRqyy\ne5bqj3FL9gW5kBe5lniyfD/mvFnv/DKncYLitMitI7YsIvx0H4VGW1Rllxo5UnXR\nzmLEfZAUanDpmlHS9bUAsi/lR75ClGW2kl/A23bB2b4ICHf0aV6gD+EIB9YLQexg\nc4YXJdmttbuFCv4/CXHzRHmLdF5wWeAeWsaG1+LVLmDdgko4JzGSiIsfe7jg3Asc\nAs7vG5c0TS4dOMD4r7tT30C4TAZWshBEYWUR58eyZaKXbc4ab31f4lKLcbngHCIc\nbawgRJadqbhKBL2FWm35/KL+XWy4FgHhY6pjgWFzTNtMw+j306B+0IpaQNf/mks8\nyTxskX3nAgMBAAECggEABElb3euzDGjP+DyptgOpcqf2U0+Cec18mawLprMqZLW3\n2UpWH+sWewbUk6sbOcKLae1XETRkbLKt8cPaiywq3Y2GtdPEQJ9xvxLQDBdTwIaw\nRWZFDVgU1ihgOE7a/oHARxgqGXv2lYD6lK6aBgpWf7a6iRzAGUg6A27hspxfaoUH\nqGzFCzAJeqdcDIsSXHEZW+k1+x9us5aC2J9lB4wyuaqIqktFjPJCdswPx9xsLr2X\nZn6SPYiTGRTgZnew1Yk/zsvjCaT8lsZja6auq7IclkCj//n5EnLmhtaD20V37eaV\n1JEAnNo1F1VE66JLf6nMPY+WauRESAjVHZFPqAY7EQKBgQD5KRoihM/aZXEx0x6P\n6Y9Wv7gk8cGL23Pb1snrDKFtmXdeXfbH+sz8mOgq9Y1Q95eHPpNpG4XvARC7FQoU\nBU0fkVk3mXmY2TwxLMObJJzq4zOQCAGIZ0GrKfYh94PgqZ5FFiaPVQ2edVCEOE3Y\nK54zzkdC6a0sTWp1Eex6EPlv2QKBgQDcgQA07tmNe+VVZCHW9IqYU/lLUgWzLXUB\n30iajrqln0hZqDFhL/0RDcifQs2QLnN928NHoJBEttAExwQ66xIRIn6Ts/gVVt3y\nfjbQLPsfoTBKKoyu3+k+EoLACrKW76mpAwI0UDLYAgWtiljmXguXcvcxcTmsz3/9\nmBofxjODvwKBgQDM/LHRwG65AUh1c3nrcH5LIoQ/cN6JT80sCrQou0V8RAxfCPNl\nZ8OJ9crcvRS8jlaOID9q9AfmsHuxTwfxnMLsu8oo4g2WYPMSif+L/j1TSgU79Do+\nnKT8SxOCsn4/MY1SzXx/47vGqEHL5f61YH1Rpd4fAN1GW5LAKjTh4GE3UQKBgQCI\nNF8OU2Oq05crkfidMNzTjzt0XSwMK84U4/mTDwsX9zXXu98Uq3HksOD2D2uu3iKU\n4cTUX8f9yfbgnJZuVnoIf4g0cHyTod7jRTdSjBZqyURs66+O7dzDbOe6/GCof04L\nikI4Ujm12DntooGbewgp+ufacJgxuNLUsLmiWunDPQKBgQDIOJQDES/WstOGmTSl\nRxiOxMmkcoxyNrbnTVgRnJJsMTvjo9HzU71ZnGDn5RP2GCK01JaVd/WBZH7HDOLU\nhTSqPnSMX/e2dJkT4IIpUZdhcXaLJDVkf3GDqpEGE2rUv0RTLBnb3MTkDwA/n7rf\nnuvn61fUK/FXONx/h52JZOZgig==\n-----END PRIVATE KEY-----\n";

                    $payload = array(
                        "aud" => "https://identitytoolkit.googleapis.com/google.identity.identitytoolkit.v1.IdentityToolkit",
                        "iat" => time(),
                        "exp" =>  strtotime(date("Y/m/d H:i:s", strtotime("+30 minutes"))),
                        "iss" => "firebase-adminsdk-b71mj@dschat-b633c.iam.gserviceaccount.com",
                        "sub" => "firebase-adminsdk-b71mj@dschat-b633c.iam.gserviceaccount.com",
                        "uid" => strval(Auth::id()),
                    );
                    $firebase_token = JWT::encode($payload, $privateKey, 'RS256');

                return [
                    'vendor_id' =>(integer) $data->vendor_id,
                    'vendor_name' =>(string) $userInfo->name,
                    'firebase_token' => $firebase_token,

                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
