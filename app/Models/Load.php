<?php

namespace App\Models;

use App\Models\Quantity;

use Illuminate\Database\Eloquent\Model;

use DB;

class Load extends Model
{
    //
    protected $guarded = [];
    protected $dates = ['date'];

    public static function make($request)
    {
        DB::beginTransaction();
        $load = self::create([
            'no'=>$request->no,
            'date'=>$request->date,
            'from_id'=>$request->from_id,
            'to_id'=>$request->to_id,
            'notes'=>$request->notes,
        ]);

        foreach(json_decode($request->items , true) as $item)
        {

            // create the detail
            $load->loadDetails()->create(
                [
                    'item_id'=>$item['item_id'] ,
                    'quantity'=>$item['quantity']
                ]
            );
            // decrease the from quantities
           Quantity::where([
                'store_id'=>$load->from_id,
                'item_id'=>$item['item_id'],
            ])->decrement('quantity',$item['quantity']);

            $quantity  = Quantity::firstOrCreate([
                'store_id'=>$load->to_id,
                'item_id'=>$item['item_id'],
            ]);
            $quantity->increment('quantity',$item['quantity']);
        }
        DB::commit();

    }


    public function loadDetails()
    {
        return $this->hasMany('App\Models\LoadDetail');
    }
    public function deleteLoad()
    {   
        DB::beginTransaction();
        $items = $this->loadDetails()->select('item_id','quantity')->get();
        $load = $this;
        foreach($items as $item)
        {
            Quantity::where([
                'store_id'=>$load->from_id,
                'item_id'=>$item['item_id'],
            ])->increment('quantity',$item['quantity']);

            Quantity::where([
                'store_id'=>$load->to_id,
                'item_id'=>$item['item_id'],
            ])->decrement('quantity',$item['quantity']);
        }

        $this->loadDetails->each->delete();
        $this->delete();
        
        DB::commit();
    
    }


    public function from()
    {
        return $this->belongsTo('App\Models\Store','from_id');
    }

    
    public function to()
    {
        return $this->belongsTo('App\Models\Store','to_id');
    }
}
