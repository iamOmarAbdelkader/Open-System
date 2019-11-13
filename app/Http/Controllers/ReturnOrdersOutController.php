<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\DataTables\ReturnOrdersOutDataTable;
use App\DataTables\OrderDetailsDataTable;

class ReturnOrdersOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReturnOrdersOutDataTable $dataTable)
    {
        return $dataTable->render('return-orders-out.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Order $order)
    {
        if($order->canBeReturned()){
            return view('return-orders-out.create',compact('order'));
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request  , Order $order)
    {
        $order->returnOut($request);
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('return-orders-out.index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $Order , OrderDetailsDataTable $dataTable)
    {
        return $dataTable->render('return-orders-out.show',['order'=>$Order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
        $order->deleteReturnOut($request);
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('return-orders-out.index');  
    }
}
