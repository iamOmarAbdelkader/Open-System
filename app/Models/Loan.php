<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Loan extends Model
{
    //
    protected $guarded = [];

    protected $dates = ['date'];

    public static function createLoan($request)
    {
        DB::beginTransaction();
        // first create the loan 
        $loan = self::create([
            'date'=>$request->date,
            'employee_id'=>$request->employee_id,
            'reposite_id'=>$request->reposite_id,
            'notes'=>$request->notes,
            'cost'=>$request->cost,
        ]);
        // second decrease the reposite balance
        $loan->reposite()->decrement('balance',$loan->cost);
        DB::commit();
    }


    public  function deleteLoan()
    {
        DB::beginTransaction();
        $this->reposite()->increment('balance',$this->cost);
        $this->delete();
        DB::commit();
    }


    public  function updateLoan($request)
    {
        DB::beginTransaction();
        $this->reposite()->increment('balance',$this->cost);
        $this->update($request->all());
        $this->reposite()->decrement('balance',$request->cost);
        DB::commit();
    }


    public function reposite()
    {
        return $this->belongsTo('App\Models\Reposite');
    }
}
