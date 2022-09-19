<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $terms_and_condition = Page::where('type','terms_and_condition')->first();
        $payments_term = Page::where('type','payments_term')->first();
        $privacy_policy = Page::where('type','privacy_policy')->first();
        $faq = Page::where('type','faq')->first();
        $about_us = Page::where('type','about_us')->first();
        $contact_us = Page::where('type','contact_us')->first();
        // dd($offer_end_time);
        return view('backend.admin.pages.index',compact('terms_and_condition','payments_term','privacy_policy','faq','about_us','contact_us'));
    }
    public function editorShow(Request $request)
    {
        $page = Page::where('type',$request->type)->first()->value;
        return $page;
    }


    public function pageDataUpdate(Request $request){
        //dd($request->all());
        $page = Page::where('type',$request->type)->first();
        $page->value = $request->value;
        $page->save();
        return 1;
    }
}
