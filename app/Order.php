<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    public function products()
    {
        return $this->belongsToMany('App\Product')->withTimestamps();
    }

    public function getRouteKeyName()
    {
        return 'order';
    }
}
