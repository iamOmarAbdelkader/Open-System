<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Supplier;
use App\Models\Item;
use App\Models\Store;
use App\Models\Order;

use App\DataTables\OrdersOutDataTable;

use App\DataTables\OrderDetailsDataTable;


class OrdersOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrdersOutDataTable $dataTable)
    {
        return $dataTable->render('orders-out.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $items = Item::select('name','id')->get();
        $suppliers = Supplier::select('id','name')->get();
        $stores = Store::select('id','name')->get();
        return view('orders-out.create',compact('items','suppliers','stores'));
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
        Order::out($request);
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('orders-out.index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $Order , OrderDetailsDataTable $dataTable)
    {
        return $dataTable->render('orders-out.show',['order'=>$Order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $orders_out)
    {
        //
        $items = Item::select('name','id')->get();
        $suppliers = Supplier::select('id','name')->get();
        $stores = Store::select('id','name')->get();
        $order =  $orders_out;
        return view('orders-out.edit',compact('order','items','suppliers','stores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $orders_out)
    {
        $orders_out->updateOut($request);
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('orders-out.index');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $orders_out )
    {
        $orders_out->deleteOut();
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('orders-out.index'); 
    }
}
