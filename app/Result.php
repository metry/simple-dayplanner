<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $guarded = ['id'];

    public static function storeResult(array $data)
    {
        return self::forceCreate($data);
    }
}
