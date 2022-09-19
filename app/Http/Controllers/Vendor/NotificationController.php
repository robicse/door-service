<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Notification;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getNotification($vendorId)
    {
        $notification = Notification::where('from', $vendorId)->latest()->first();
        $notifications = Notification::where('from', $vendorId)->where('is_read',0)->latest()->get();
        $count = count($notifications);
        //echo 'controller'; die();
        return response()->json(['success'=> true, 'response'=>$notification, 'noti_count' => $count]);
    }
    public function clearAllNotification($vendorId)
    {
        $notifications = Notification::where('from', $vendorId)->get();
        foreach ($notifications as $notification) {
            $notifications = Notification::find($notification->id);
            $notification->delete();
        }
        Toastr::success('All Notification Clear Successfully');
        return back();
    }
    public function readNotification($id)
    {
        $notification = Notification::find($id);
        $notification->is_read = 1;
        $notification->save();
        return redirect()->route('vendor.request_order_list');
    }
}
