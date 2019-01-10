<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = ['id'];

    public static function storeCustomer(array $data)
    {
        return self::forceCreate($data);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function getPhoneNumericAttribute()
    {
        return preg_replace("/[^0-9]/", '', $this->phone);
    }

    public static function searchCustomers($request, $countOnPage)
    {
        return Customer::where('name', 'LIKE', "%". $request ."%")
            ->orWhere('phone', 'LIKE', "%". $request ."%")
            ->orWhere('email', 'LIKE', "%". $request ."%")
            ->orWhere('instagram', 'LIKE', "%". $request ."%")
            ->orWhere('vk', 'LIKE', "%". $request ."%")
            ->orWhere('address', 'LIKE', "%". $request ."%")
            ->orderBy('id', 'desc')
            ->paginate($countOnPage);
    }
}
