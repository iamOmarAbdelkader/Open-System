<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Storage;

class Employee extends Model
{
    //
    protected $guarded = [];
    protected $dates = ['date_of_birth','date_of_appointment'];


    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function job()
    {
        return $this->belongsTo('App\Models\Job');
    }


    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance');
    }


    public function loans()
    {
        return $this->hasMany('App\Models\Loan');
    }

    public function stores()
    {
        return $this->hasMany('App\Models\Store');
    }

    public function setIdImage1Attribute($file)
    {
        if(isset($this->attributes['id_image_1']))
        {
         Storage::delete($this->attributes['id_image_1']);            
        }
        $path = request()->file('id_image_1')->store('public/employees');
        $this->attributes['id_image_1'] =$path;
    }

    public function setIdImage2Attribute($file)
    {
        if(isset($this->attributes['id_image_2']))
        {
         Storage::delete($this->attributes['id_image_2']);            
        }
        $path = request()->file('id_image_2')->store('public/employees');
        $this->attributes['id_image_2'] =$path;
    }

    public function getIdImage1Attribute()
    {
        if($this->attributes['id_image_1'])
        {
            $src = asset(Storage::url($this->attributes['id_image_1']));
        }
        else
        {
            $src = asset(Storage::url('default/default.jpg'));
        }
        return $src;
    }

    public function getIdImage2Attribute()
    {
        if($this->attributes['id_image_2'])
        {
            $src = asset(Storage::url($this->attributes['id_image_2']));
        }
        else
        {
            $src = asset(Storage::url('default/default.jpg'));
        }
        return $src;
    }



    // 
    public function setCvAttribute($file)
    {
        if(isset($this->attributes['cv']))
        {
         Storage::delete($this->attributes['cv']);            
        }
        $path = request()->file('cv')->store('public/employees');
        $this->attributes['cv'] =$path;
    }

    public function setCriminalRecordAttribute($file)
    {
        if(isset($this->attributes['criminal_record']))
        {
         Storage::delete($this->attributes['criminal_record']);            
        }
        $path = request()->file('criminal_record')->store('public/employees');
        $this->attributes['criminal_record'] =$path;
    }

    // public function getCvAttribute()
    // {
    //     if(isset($this->attributes['criminal_record']))
    //     {
    //      return  Storage::download($this->attributes['criminal_record']);            
    //     }
    //     else return null;
    // }

    // public function getCriminalRecordAttribute()
    // {
    //     if(isset($this->attributes['cv']))
    //     {
    //      return  Storage::download($this->attributes['cv']);            
    //     }
    //     else return null;
    // }

}
