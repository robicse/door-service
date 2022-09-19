<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceQuestion extends Model
{
    public function services_manages()
    {
        return $this->hasOne('App\ServiceManage');
    }
    /*public function questionOptions()
    {
        return $this->hasMany('App\ServiceQuestionOption','service_question_id');
    }*/
}
