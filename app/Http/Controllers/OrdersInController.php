<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Store;
use App\Models\Order;

use App\DataTables\OrdersInDataTable;

use App\DataTables\OrderDetailsDataTable;
class OrdersInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrdersInDataTable $dataTable)
    {
        return $dataTable->render('orders-in.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $items = Item::select('name','id')->get();
        $clients = Client::select('id','name')->get();
        $stores = Store::whereHas('quantities',function( $query ) {$query->where('quantity','>','0');})
        ->select('id','name')
        ->get();
        return view('orders-in.create',compact('items','clients','stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Order::in($request);
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('orders-in.index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $Order , OrderDetailsDataTable $dataTable)
    {
        return $dataTable->render('orders-in.show',['order'=>$Order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $orders_in)
    {
        // //
        // $clients = Client::select('id','name')->get();
        // $stores = Store::has('quantities')->select('id','name')->get();
        // $order =  $orders_in;
        // return view('orders-in.edit',compact('order','clients','stores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $orders_in)
    {
        //
        // $orders_in->updateIn($request);
        // flash('تمت العمليه بنجاح')->success();
        // return redirect()->route('orders-in.index');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $orders_in )
    {
        $orders_in->deleteIn();
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('orders-in.index'); 
    }
}
