<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $guarded = [];

    public function services_sub_category()
    {
        return $this->hasMany('App\ServicesSubCategory','category_id');
    }

}
