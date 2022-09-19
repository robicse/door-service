<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Career;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;
    public function CareerStore(Request $request)
    {
        //return response()->json(['success'=>1], $this-> successStatus);

        //dd($request->all());

        $fname = $request->firstname;
        $lname = $request->lastname;
        $email = $request->email;
        $phone = $request->phone;
        $resume = $request->resume;

        $msg = '
        <html>
            <head>
              <title>Mail from ' . $fname .' '. $lname.'</title>
            </head>
            <body>
              <table style="width: 500px; font-family: arial; font-size: 14px;" border="1">
               <tr style="height: 32px;">
                 <th align="right" style="width:150px; padding-right:5px;">Name:</th>
                 <td align="left" style="padding-left:5px; line-height: 20px;">' .$fname .' '. $lname. '</td>
               </tr>

               <tr style="height: 32px;">
                 <th align="right" style="width:150px; padding-right:5px;">Phone:</th>
                 <td align="left" style="padding-left:5px; line-height: 20px;">' . $phone . '</td>
               </tr>
               <tr style="height: 32px;">
                 <th align="right" style="width:150px; padding-right:5px;">E-mail:</th>
                 <td align="left" style="padding-left:5px; line-height: 20px;">' . $email . '</td>
               </tr>
               <tr style="height: 32px;">
                 <th align="right" style="width:150px; padding-right:5px;">Resume:</th>
                 <td align="left" style="padding-left:5px; line-height: 20px;">' . $resume . '</td>
               </tr>
              </table>
            </body>
        </html>';

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'From: ' . $email . "\r\n";

        if(mail('ashiq.starit@gmial.com',$email,$msg,$headers)){
            //Toastr::success('Message Sent Successfully','Success');
            return response()->json(['success'=>1], $this-> successStatus);
        }else{
            return response()->json(['success'=>0], $this-> successStatus);
        }

    }

    public function careerList()
    {
        $success['careers'] = Career::latest()->get();
        return response()->json(['success'=>$success], $this-> successStatus);
    }
}
