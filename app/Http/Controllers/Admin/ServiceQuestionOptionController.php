<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ServiceQuestionOption;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ServiceQuestionOptionController extends Controller
{
    public function questionWiseOptionStore(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'option_title' => 'required',
        ]);

        for ($i=0; $i < count($request->option_title); $i++) {
            $service = new ServiceQuestionOption();
            $service->service_question_id = $request->service_question_id;
            $service->option_title = $request->option_title[$i];
            if(empty($request->option_price[$i])) {
                $service->option_price = 0;
            }else{
                $service->option_price = $request->option_price[$i];
            }

            $service->save();
        }

        Toastr::success('Service Questions Inserted Successfully Done!');
        return redirect()->back();
    }

    public function questionOptionUpdate(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'option_title' => 'required',
        ]);

        $check = ServiceQuestionOption::where('service_question_id',$request->service_question_id)->get();
        foreach ($check as $data) {
            $delete =  ServiceQuestionOption::find($data->id);
            $delete->delete();
        }

        for ($i=0; $i < count($request->option_title); $i++) {
            $service = new ServiceQuestionOption();
            $service->service_question_id = $request->service_question_id;
            $service->option_title = $request->option_title[$i];
            if(empty($request->option_price[$i])) {
                $service->option_price = 0;
            }else{
                $service->option_price = $request->option_price[$i];
            }
            $service->save();
        }

        Toastr::success('Service Questions Option Successfully Done!');
        return redirect()->back();
    }
}
