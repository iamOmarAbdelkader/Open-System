<?php

namespace App\Models;

use App\Notifications\UserResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;
    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    public function setPasswordAttribute($val)
    {
        $this->attributes['password'] = bcrypt($val);
    }

}
