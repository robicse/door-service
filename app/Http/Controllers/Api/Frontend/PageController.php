<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Page;
use App\Slider;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function pages($type){
        $page = Page::where('type',$type)->first();
        if (!empty($page))
        {
            return response()->json(['success'=>true,'response'=> $page], 200);
        }
        else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }
    public function contactSubmit(Request $request){
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $subject = $request->subject;
        $message = $request->message;

        $msg = '
<html>
<head>
  <title>Mail from ' . $name . '</title>
</head>
<body>
  <table style="width: 500px; font-family: arial; font-size: 14px;" border="1">
   <tr style="height: 32px;">
     <th align="right" style="width:150px; padding-right:5px;">Name:</th>
     <td align="left" style="padding-left:5px; line-height: 20px;">' . $name . '</td>
   </tr>

   <tr style="height: 32px;">
     <th align="right" style="width:150px; padding-right:5px;">E-mail:</th>
     <td align="left" style="padding-left:5px; line-height: 20px;">' . $email . '</td>
   </tr>
   <tr style="height: 32px;">
     <th align="right" style="width:150px; padding-right:5px;">Phone:</th>
     <td align="left" style="padding-left:5px; line-height: 20px;">' . $phone . '</td>
   </tr>
   <tr style="height: 32px;">
     <th align="right" style="width:150px; padding-right:5px;">Subject:</th>
     <td align="left" style="padding-left:5px; line-height: 20px;">' . $subject . '</td>
   </tr>
   <tr style="height: 32px;">
     <th align="right" style="width:150px; padding-right:5px;">Message:</th>
     <td align="left" style="padding-left:5px; line-height: 20px;">' . $message . '</td>
   </tr>
  </table>
</body>
</html>
';

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'From: ' . $email . "\r\n";

        if(mail('info@doorservice.com',$subject,$msg,$headers)){
            return response()->json(['success'=>true,'response' => 'Message sent successfully'], 200);
        }else{
            return response()->json(['success'=>false,'response' => 'Web mail not found '], 404);
        }

    }
    public function sliderList(){
        $sliders = Slider::select('id','image','url')->latest()->get();
        if (!empty($sliders)){
            return response()->json(['success'=>true,'response' => $sliders], 200);
        }else{
            return response()->json(['success'=>false,'response' => 'Sliders not found '], 404);
        }
    }

}
