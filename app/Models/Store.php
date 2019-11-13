<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    //
    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }


    public function quantities()
    {
        return $this->HasMany('App\Models\Quantity');
    }


    public function scopeOfType($query , $type)
    {
        $query->where('type',$type);
    }
}
