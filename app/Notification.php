<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];
    public function sender()
    {
        return $this->belongsTo('App\User','from');
    }
    public function receiver()
    {
        return $this->belongsTo('App\User','to');
    }

}
