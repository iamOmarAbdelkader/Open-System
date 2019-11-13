<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Role;
use App\Models\Permission;

use DB;
use App\DataTables\RolesDataTable;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create',compact('permissions'));
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
        DB::beginTransaction();
        $role = Role::create(['name'=>$request->name]);
        $role->attachPermissions($request->permissions);
        DB::commit();
        flash('تمت العملية بنجاح')->success();
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();        
        return view('roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
        
        DB::beginTransaction();
        $role->update(['name'=>$request->name]);
        $role->perms()->sync([]);
        $role->attachPermissions($request->permissions);
        DB::commit();

        flash('تمت العملية بنجاح')->success();
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        DB::beginTransaction();
        $role->delete(); // This will work no matter what
        // // Force Delete
        $role->users()->sync([]); // Delete relationship data
        $role->perms()->sync([]); // Delete relationship data

        $role->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete
        DB::commit();
        flash('تمت العملية بنجاح')->success();
        return redirect()->route('roles.index');
    }
}
