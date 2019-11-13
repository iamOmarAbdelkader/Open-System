<?php

namespace App\Http\Controllers;

use App\Models\Load;
use Illuminate\Http\Request;

use App\Models\Store;

use App\DataTables\LoadDataTable;

use App\DataTables\LoadDetailsDataTable;

class LoadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LoadDataTable $dataTable)
    {
        return $dataTable->render('load.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = Store::whereHas('quantities',function($query){
            $query->where('quantity','>','0');
        })->get();

        $to = Store::all();
        return view('load.create',compact('stores','to'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Load::make($request);
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('load.index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Load $load , LoadDetailsDataTable $dataTable)
    {
        return $dataTable->render('load.show',['load'=>$load]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Load $load)
    {
        // //
        // $clients = Client::select('id','name')->get();
        // $stores = Store::has('quantities')->select('id','name')->get();
        // $order =  $load;
        // return view('load.edit',compact('order','clients','stores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Load $load)
    {
        //
        // $load->updateIn($request);
        // flash('تمت العمليه بنجاح')->success();
        // return redirect()->route('load.index');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Load $load )
    {
        $load->deleteLoad();
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('load.index'); 
    }
}
