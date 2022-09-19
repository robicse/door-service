<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorService extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\ServiceCategory', 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\ServicesSubCategory', 'subcategory_id');
    }

    public function service()
    {
        return $this->belongsTo('App\ServiceManage', 'service_id');
    }
}
