<?php

namespace App\Http\Controllers\Frontend\User;

use App\Feedback;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function SendFeedback(){

        return view('Frontend.Users.service_order-history');

    }

    public function StoreFeedback(Request $request)
    {

        $this->validate($request, [
            'comments' => 'required',
        ]);
        $feedback=new Feedback();
        $feedback->user_id = Auth::id();
        $feedback->comments = $request->comments;
        $feedback->service_id = $request->service_id;
        $feedback->save();
        Toastr::success('Feedback Send Successfully','Success');
        return redirect()->back();


    }
}
