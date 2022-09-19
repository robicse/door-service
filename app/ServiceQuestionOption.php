<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceQuestionOption extends Model
{
    protected $guarded = [];

    public function question()
    {
        return $this->belongsTo('App\ServiceQuestion','service_question_id');
    }
}
