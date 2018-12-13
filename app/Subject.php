<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = ['id'];

    public static function storeSubject(array $data)
    {
        return self::forceCreate($data);
    }
}
