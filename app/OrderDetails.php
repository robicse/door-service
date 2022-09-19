<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo('App\Order','order_id');
    }
    public function service()
    {
        return $this->belongsTo('App\ServiceManage','service_id');
    }
}
