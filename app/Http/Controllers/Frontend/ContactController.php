<?php

namespace App\Http\Controllers\Frontend;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function Index()
    {
        return view('frontend.pages.contact');
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'message' => 'required',
            'service' => 'required',
        ]);
        $name = $request->name;
        $email = $request->email;
        $address = $request->address;
        $phone = $request->contact;
        $message = $request->message;
        $service = $request->service;

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
     <th align="right" style="width:150px; padding-right:5px;">Phone:</th>
     <td align="left" style="padding-left:5px; line-height: 20px;">' . $phone . '</td>
   </tr>
   <tr style="height: 32px;">
     <th align="right" style="width:150px; padding-right:5px;">E-mail:</th>
     <td align="left" style="padding-left:5px; line-height: 20px;">' . $email . '</td>
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

        if(mail('meem.starit@gmail.com',$address,$msg,$headers)){
            Toastr::success('Message Sent Successfully','Success');
        }else{
            Toastr::error('Something went wrong! Please try again','Error');
        }
        return redirect()->back();
    }
}

