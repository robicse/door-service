<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\ServiceManage;
use App\ServiceQuestion;
use App\ServiceQuestionOption;
use Illuminate\Http\Request;

class QuestionOptionController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;

    public function serviceWiseQuestionOption(Request $request)
    {
        $service = ServiceManage::where('slug', $request->service_slug)->first();
        if (empty($service)) {
            return response()->json(['slug-match'=> 'slug does not matched' ], $this-> successStatus);
        }else{

            $result = Array();
            $result2 = $service->service_price;
            $serviceQuestions = ServiceQuestion::where('service_id', $service->id)->get();
            foreach ($serviceQuestions as $serviceQuestion){
               $serviceQuestionOptions = ServiceQuestionOption::where('service_question_id', $serviceQuestion->id)->get();
                $serviceQuestion->questionsOption = (sizeof($serviceQuestionOptions) > 0) ? $serviceQuestionOptions : [];
                array_push($result, $serviceQuestion);
            }

            //$success['question'] =
            return response()->json(['question'=> $result,'service_price' => $result2], $this-> successStatus);
        }

    }
}
