<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function vendorUser()
    {
        return $this->belongsTo('App\User','vendor_id');
    }
}
