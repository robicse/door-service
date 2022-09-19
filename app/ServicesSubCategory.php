<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicesSubCategory extends Model
{
    protected $guarded = [];

    public function services_category()
    {
        return $this->belongsTo('App\ServiceCategory');
    }
}
