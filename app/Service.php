<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded =[];
    protected $table= 'services';
//    public function serviceCategory()
//    {
//        return $this->belongsTo('App\ServiceCategory','service_category_id');
//    }
//    public function serviceSubCategory()
//    {
//        return $this->belongsTo('App\ServiceSubcategory','service_subcategory_id');
//    }
}
