<?php

namespace App\Http\Controllers;

use App\Models\Reposite;
use Illuminate\Http\Request;

use App\DataTables\RepositesDataTable;

class RepositeController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RepositesDataTable $dataTable)
    {
        return $dataTable->render('reposites.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view('reposites.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            Reposite::create($request->all());
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('reposites.index');        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reposite  $reposite
     * @return \Illuminate\Http\Response
     */
    public function show(Reposite $reposite)
    {

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reposite  $reposite
     * @return \Illuminate\Http\Response
     */
    public function edit(Reposite $reposite)
    {
            return view('reposites.edit',[
                'reposite'=>$reposite,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reposite  $reposite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reposite $reposite)
    {
        $reposite->update($request->all());
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('reposites.index');      
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reposite  $reposite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reposite $reposite)
    {
        $reposite->delete();
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('reposites.index');  
    }
}
