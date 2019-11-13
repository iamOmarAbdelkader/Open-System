<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $guarded = [];

    public function detail()
    {
        return $this->hasOne('App\Models\Detail');
    }

}
