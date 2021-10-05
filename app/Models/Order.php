<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone', 'email', 'delivery_type', 'address', 'notice', 'discount_id', 'discount_code', 'discount_value'];

    protected $appends = ['delivery_type'];

    //Needs to be camel case of $appends
    public function getDeliveryTypeAttribute() {
        return $this->delivery_type()->first();
    }

    public function delivery_type() {
        return $this->belongsTo('App\Models\DeliveryType', 'delivery_type', 'type');  // Again, not the Laravel-iest keys
    }

    public function items() {
        return $this->hasMany('App\Models\OrderItem');
    }
}
