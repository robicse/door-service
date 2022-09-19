<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];
    //protected $table= 'reviews';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\User', 'vendor_user_id');
    }
}
