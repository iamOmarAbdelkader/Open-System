<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\Models\Quantity;

use App\Traits\ReturnsTrait;

class Order extends Model
{
    //
    use ReturnsTrait;
    
    
    protected $guarded = [];
    protected $dates = ['date'];
    protected $appends = ['max','payed'];


      //relations
      public function orderDetails()
      {
          return $this->hasMany('App\Models\OrderDetail');
      }

      public function accounts()
      {
          return $this->hasMany('App\Models\Account');
      }

      public function orders()
      {
          return $this->hasMany('App\Models\Order');
      }

      public function store()
      {
          return $this->belongsTo('App\Models\Store');
      }

      public function parent()
      {
          return $this->belongsTo('App\Models\Order','order_id');
      }

  
      public function ownerable()
      {
          return $this->morphTo();
      }


    public static function out($request)
    {
        DB::beginTransaction();
        //first create the order
        $order = self::create([
            'type'=>'out',
            'no'=>$request->no,
            'date'=>$request->date,
            'ownerable_id'=>$request->supplier_id,
            'ownerable_type'=>'App\Models\Supplier',
            'store_id'=>$request->store_id,
            'total'=>$request->total,
            'vat'=>$request->vat,
            'discount'=>$request->discount,
            'final_total'=>$request->final_total,
            'notes'=>$request->notes,
        ]);
        //secod create the order details and add quantities
        $order->incQuantities(json_decode($request->items , true));
        $order->details(json_decode($request->items , true));
        //set the balance of the supplier
        $order->ownerable->setBalance(-$request->final_total);
        DB::commit();
    }


    public function returnOut($request)
    {
        DB::beginTransaction();
        $order =  $this->returns()->create([
            'type'=>'in',
            'no'=>$request->no,
            'date'=>$request->date,
            'ownerable_id'=>$this->ownerable_id,
            'ownerable_type'=>$this->ownerable_type,
            'store_id'=>$this->store_id,
            'total'=>$request->total,
            'vat'=>$request->vat,
            'discount'=>$request->discount,
            'final_total'=>$request->final_total,
            'notes'=>$request->notes,
        ]);

        $order->decQuantities(json_decode($request->items , true));
        $order->details(json_decode($request->items , true));

        // to calc what is the owner accounts
        $order->ownerable->setBalance($request->final_total);
        DB::commit();
        // 
    }

    public function deleteReturnOut()
    {
        DB::beginTransaction();
        $details = $this->orderDetails()->select('item_id','quantity')->get();
        $this->incQuantities($details);
        // to calc what is the owner accounts
        $this->ownerable->setBalance(-$this->final_total);
        DB::commit();
        // 
    }


    public function returnIn($request)
    {
        DB::beginTransaction();
        $order =  $this->returns()->create([
            'type'=>'out',
            'no'=>$request->no,
            'date'=>$request->date,
            'ownerable_id'=>$this->ownerable_id,
            'ownerable_type'=>$this->ownerable_type,
            'store_id'=>$this->store_id,
            'total'=>$request->total,
            'vat'=>$request->vat,
            'discount'=>$request->discount,
            'final_total'=>$request->final_total,
            'notes'=>$request->notes,
        ]);

        $order->incQuantities(json_decode($request->items , true));
        $order->details(json_decode($request->items , true));
        // to calc what is the owner accounts
        $order->ownerable->setBalance(-$request->final_total);
        DB::commit();
    }

    public function deleteReturnIn()
    {
        DB::beginTransaction();
        $details = $this->orderDetails()->select('item_id','quantity')->get();
        $this->decQuantities($details);
        // to calc what is the owner accounts
        $this->ownerable->setBalance($this->final_total);
        DB::commit();
        // 
    }

    public function incQuantities($items)
    {
        foreach($items as $item)
        {
            $quantity  = Quantity::firstOrCreate([
                'store_id'=>$this->store_id,
                'item_id'=>$item['item_id'],
            ]);
            $quantity->increment('quantity',$item['quantity']);
        }
    }

    public function decQuantities($items)
    {
            foreach($items as $item)
            {
                Quantity::where([
                    'item_id'=>$item['item_id'] , 
                    'store_id'=>$this->store_id
                ])->decrement('quantity',$item['quantity']);
            }
    }



    public function details($items)
    {
        foreach($items as $item)
        {
            $this->orderDetails()->create([
                'item_id'=>$item['item_id'],
                'discount'=>$item['discount'],
                'quantity'=>$item['quantity'],
                'unite_price'=>$item['unite_price'],
            ]);
        }
    }



    public function deleteOut()
    {

        DB::beginTransaction();
        // first pick item_id , quantity , store_id
        $details = $this->orderDetails()->select('item_id','quantity')->get();
        //second decremt the quantities
        $this->decQuantities($details);
        // delete order details
        $this->orderDetails->each->delete();
        // third decrease balance
        $this->ownerable->setBalance($this->final_total);
        // delete the order
        $this->delete();
        DB::commit();
    }


    public function updateOut($request)
    {

        DB::beginTransaction();
        // first pick item_id , quantity , store_id
        $details = $this->orderDetails()->select('item_id','quantity')->get();
        //second decremt the quantities
        $this->decQuantities($details);
        // delete order details
        $this->orderDetails->each->delete();
        // third decrease balance
        $this->ownerable->setBalance(-$this->final_total);
        // update it 
        
        $this->update([
            'no'=>$request->no,
            'date'=>$request->date,
            'ownerable_id'=>$request->supplier_id,
            'ownerable_type'=>'App\Models\Supplier',
            'store_id'=>$request->store_id,
            'total'=>$request->total,
            'vat'=>$request->vat,
            'discount'=>$request->discount,
            'final_total'=>$request->final_total,
            'notes'=>$request->notes,
        ]);
        //secod create the order details and add quantities
        $this->incQuantities(json_decode($request->items , true));
        $this->details(json_decode($request->items , true));
        //set the balance of the supplier
        $this->ownerable->setBalance($request->final_total);
        DB::commit();
        // dd($this->ownerable);
    }




    public static function in($request)
    {
        DB::beginTransaction();
        //first create the order
        $order = self::create([
            'type'=>'in',
            'no'=>$request->no,
            'date'=>$request->date,
            'ownerable_id'=>$request->client_id,
            'ownerable_type'=>'App\Models\Client',
            'store_id'=>$request->store_id,
            'total'=>$request->total,
            'vat'=>$request->vat,
            'discount'=>$request->discount,
            'final_total'=>$request->final_total,
            'notes'=>$request->notes,
        ]);
        //secod create the order details and add quantities
        // $order->incQuantities(json_decode($request->items , true));
        $order->decQuantities(json_decode($request->items , true));
        $order->details(json_decode($request->items , true));
        //set the balance of the supplier
        $order->ownerable->setBalance($request->final_total);
        DB::commit();
    }


    public function deleteIn()
    {

        DB::beginTransaction();
        // first pick item_id , quantity , store_id
        $details = $this->orderDetails()->select('item_id','quantity')->get();
        $this->incQuantities($details);
        // delete order details
        $this->orderDetails->each->delete();
        // third decrease balance
        $this->ownerable->setBalance(-$this->final_total);
        // delete the order
        $this->delete();
        DB::commit();
    }
  

    // attributes
    public function getMaxAttribute()
    {
        $val = $this->payed;
        $returns = $this->orders()->sum('final_total');
        $max = ($this->final_total  - $returns ) - $val ;
        return ($max>0)?$max:0;
       
    }

    public function getPayedAttribute()
    {
        return $this->accounts()->sum('cost');
    }

}
