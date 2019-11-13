<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //
    protected $guarded = [];
    protected $dates = ['date'];

    public static function createAccount($request)
    {
        $owners = [
            'supplier'=>'App\Models\Supplier',
            'client'=>'App\Models\Client',
        ];

        // check the type of the account
        $account = self::create([
            'no'=>$request->no,
            'type'=>$request->type,
            'order_id'=>$request->order_id,
            'cost'=>$request->cost,
            'date'=>$request->date,
            'reposite_id'=>$request->reposite_id,
            'accountable_id'=>$request->accountable_id,
            'accountable_type'=>$owners[$request->accountable_type],
        ]);


        if($request->type == 'in')
        {
            //will add the money to the reposite
            $account->reposite()->increment('balance',$account->cost);
            // will decrease the balance of the payer
            $account->accountable->setBalance(-$account->cost);
        }
        else //type is out
        {
            // decrease the money from the reposite
            $account->reposite()->increment('balance',-$account->cost);
            // increase the balance of the payer
            $account->accountable->setBalance($account->cost);
        }

    }


    public function deleteAccount()
    {
        // 
        if($this->type == 'in')
        {
            //will add the money to the reposite
            $this->reposite()->increment('balance',-$this->cost);
            // will decrease the balance of the payer
            $this->accountable->setBalance($this->cost);
        }
        else //type is out
        {
            // decrease the money from the reposite
            $this->reposite()->increment('balance',$this->cost);
            // increase the balance of the payer
            $this->accountable->setBalance(-$this->cost);
        }
        
        $this->delete();
    }


    public function updateAccount($request)
    {
        // 
        if($this->type == 'in')
        {
            //will add the money to the reposite
            $this->reposite()->increment('balance',-$this->cost);
            // will decrease the balance of the payer
            $this->accountable->setBalance($this->cost);
        }
        else //type is out
        {
            // decrease the money from the reposite
            $this->reposite()->increment('balance',$this->cost);
            // increase the balance of the payer
            $this->accountable->setBalance(-$this->cost);
        }


        $this->update([
            'no'=>$request->no,
            'type'=>$request->type,
            'order_id'=>$request->order_id,
            'cost'=>$request->cost,
            'date'=>$request->date,
            'reposite_id'=>$request->reposite_id,
        ]);
        if($request->type == 'in')
        {
            //will add the money to the reposite
            $this->reposite()->increment('balance',$this->cost);
            // will decrease the balance of the payer
            $this->accountable->setBalance(-$this->cost);
        }
        else //type is out
        {
            // decrease the money from the reposite
            $this->reposite()->increment('balance',-$this->cost);
            // increase the balance of the payer
            $this->accountable->setBalance($this->cost);
        }


        
    }




    public function accountable()
    {
        return $this->morphTo();
    }

    public function reposite()
    {
        return $this->belongsTo('App\Models\Reposite');
    }
}
