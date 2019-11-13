<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\SuppliersDataTable;

use App\Models\Supplier;
use App\Models\Actor;
use App\Models\Country;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SuppliersDataTable $dataTable)
    {
        return $dataTable->render('suppliers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $actors = Actor::all();
        return view('suppliers.create',compact('countries','actors'));
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
        Supplier::create($request->all());
        flash('تمت العملية بنجاح')->success();
        return redirect()->route('suppliers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        
        return view('suppliers.show',compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $countries = Country::all();
        $actors = Actor::all();
        return view('suppliers.edit',compact('supplier','countries','actors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $supplier->update($request->all());
        flash('تمت العملية بنجاح')->success();
        return redirect()->route('suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        flash('تمت العملية بنجاح')->success();
        return redirect()->route('suppliers.index');
    }
}
