<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\ActorsDataTable;

use App\Models\Actor;
use App\Models\Country;


class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ActorsDataTable $dataTable)
    {
        return $dataTable->render('actors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('actors.create',compact('countries'));
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
        Actor::create($request->all());
        flash('تمت العملية بنجاح')->success();
        return redirect()->route('actors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Actor $actor)
    {
        
        return view('actors.show',compact('actor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Actor $actor)
    {
        $countries = Country::all();
        return view('actors.edit',compact('actor','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actor $actor)
    {
        $actor->update($request->all());
        flash('تمت العملية بنجاح')->success();
        return redirect()->route('actors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actor $actor)
    {
        $actor->delete();
        flash('تمت العملية بنجاح')->success();
        return redirect()->route('actors.index');
    }
}
