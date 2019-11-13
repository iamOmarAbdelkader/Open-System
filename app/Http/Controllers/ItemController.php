<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Meta;
use Illuminate\Http\Request;

use App\DataTables\ItemsDataTable;


class ItemController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ItemsDataTable $dataTable)
    {
        return $dataTable->render('items.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $metas  = Meta::all();
            return view('items.create',compact('metas'));
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
        $item = Item::create($request->except('details'));
        if(is_array($request->details))
        { $item->detail()->create($request->details); }
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('items.index');        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $metas  = Meta::all();
        return view('items.show',[
                'item'=>$item,
                'metas'=>$metas
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $metas  = Meta::all();
        return view('items.edit',[
                'item'=>$item,
                'metas'=>$metas
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item->update($request->except('details'));
        if(is_array($request->details))
        { $item->detail()->update($request->details); }
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('items.index');      
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('items.index');  
    }
}
