<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationCollection;
use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;

    public function notificationList($id){
        $notifications = Notification::where('to',$id)->latest()->get();
        return new NotificationCollection($notifications);
//        if (!empty($notification)){
//            return response()->json(['success'=> true, 'response'=>$notification], $this-> successStatus);
//        }else{
//            return response()->json(['success'=> false, 'response'=>'Nothing to show'], 404);
//        }
    }
    public function notificationSubmit(Request $request){
        $notification = new Notification();
        $notification->from = $request->sender_id;
        $notification->to = $request->receiver_id;
        $notification->message = $request->message;
        $notification->is_read = 0;
        $notification->save();

        if (!empty($notification)){
            return response()->json(['success'=> true, 'response'=>'Notification created successfully'], $this-> successStatus);
        }else{
            return response()->json(['success'=> false, 'response'=>'Something went wrong'], 404);
        }
    }
    public function notificationStatus($id){
        $notification = Notification::find($id);
        $notification->is_read = 1;
        $notification->save();
        if (!empty($notification)){
            return response()->json(['success'=> true, 'response'=>'Notification Status updated successfully'], $this-> successStatus);
        }else{
            return response()->json(['success'=> false, 'response'=>'Something went wrong'], 404);
        }
    }
}
