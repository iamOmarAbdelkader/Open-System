<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    //
    protected $guarded = [];
    protected $dates = ['date'];

    public function reposite()
    {
        return $this->belongsTo('App\Models\Reposite');
    }

    public static function createDaily($request)
    {
        // first create the instance
        $daily = self::create([
            'no'=>$request->no,
            'type'=>$request->type,
            'tree_id'=>$request->tree_id,
            'date'=>$request->date,
            'cost'=>$request->cost,
            'notes'=>$request->notes,
            'reposite_id'=>$request->reposite_id,
        ]);

        if($daily->type == 'in'){
            $daily->reposite()->increment('balance',$daily->cost);
        }
        else{ // out
            $daily->reposite()->increment('balance',-$daily->cost);
        }
    }


    public function deleteDaily()
    {
        if($this->type == 'in'){
            $this->reposite()->increment('balance',-$this->cost);
        }
        else{ // out
            $this->reposite()->increment('balance',-$this->cost);
        }

        $this->delete();
    }



    public function updateDaily($request)
    {
        if($this->type == 'in'){
            $this->reposite()->increment('balance',-$this->cost);
        }
        else{ // out
            $this->reposite()->increment('balance',-$this->cost);
        }
        
        $this->update([
            'no'=>$request->no,
            'type'=>$request->type,
            'tree_id'=>$request->tree_id,
            'date'=>$request->date,
            'cost'=>$request->cost,
            'notes'=>$request->notes,
            'reposite_id'=>$request->reposite_id,
        ]);

        if($this->type == 'in'){
            $this->reposite()->increment('balance',$this->cost);
        }
        else{ // out
            $this->reposite()->increment('balance',-$this->cost);
        }


    }
}
