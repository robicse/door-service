<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceManage extends Model
{
    protected $table = 'service_manages';
    protected $guarded = [];

    public function services_question()
    {
        return $this->belongTo(ServiceManage::class);
    }
    public function vendorservice()
    {
        return $this->belongsTo('App\ServiceManage', 'service_id');
    }

    public function category()
    {
        return $this->belongsTo('App\ServiceCategory', 'category_id');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\ServicesSubCategory', 'sub_category');
    }
}
