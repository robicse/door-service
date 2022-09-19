<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded =[];
    protected $table= 'orders';
    public function orderDetails()
    {
        return $this->hasOne('App\OrderDetails','order_id');
    }
    public function vendorUser()
    {
        return $this->belongsTo('App\User','vendor_id');
    }
    public function status()
    {
        return $this->belongsTo('App\Status','status_id');
    }
    public function payment(){
        return $this->hasOne('App\PaymentHistory','order_id');
    }
    public function review()
    {
        return $this->hasOne('App\Review','order_id');
    }

    public function orderVendor()
    {
        return $this->hasOne('App\OrderVendor','order_id');
    }


}
