<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    protected $guarded = [];

    public function services_manages()
    {
        return $this->hasOne('App\ServiceManage');
    }
}
