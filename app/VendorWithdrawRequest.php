<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorWithdrawRequest extends Model
{
    public function vendor()
    {
        return $this->belongsTo('App\VendorDetails', 'user_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
