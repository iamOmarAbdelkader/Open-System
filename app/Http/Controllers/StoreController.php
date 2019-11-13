<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Employee;
use App\Models\Country;
use Illuminate\Http\Request;
use App\DataTables\StoresDataTable;
use App\DataTables\QuantitiesInStoreDataTable;
class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StoresDataTable $dataTable)
    {
        return $dataTable->render('stores.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $employees = Employee::doesnthave('stores')->get();
        return view('stores.create',compact('countries','employees'));
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
        Store::create($request->all());
        flash('تمت العملية بنجاح')->success();
        return redirect()->route('stores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store , QuantitiesInStoreDataTable $dataTable)
    {
        return $dataTable->render('stores.show',compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        $countries = Country::all();
        $employees = Employee::doesnthave('stores')
        ->orWhere('id',$store->employee_id)
        ->get();
        return view('stores.edit',compact('store','countries','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        $store->update($request->all());
        flash('تمت العملية بنجاح')->success();
        return redirect()->route('stores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $store->delete();
        flash('تمت العملية بنجاح')->success();
        return redirect()->route('stores.index');
    }
}
