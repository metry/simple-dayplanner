<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

    public static function storeOrder(array $data)
    {
        return self::forceCreate($data);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'order_id', 'id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'order_id', 'id');
    }
}
