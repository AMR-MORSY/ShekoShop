<?php

namespace App\Http\Controllers;

use App\Models\Admin_Type;
use App\Http\Requests\StoreAdmin_TypeRequest;
use App\Http\Requests\UpdateAdmin_TypeRequest;

class AdminTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdmin_TypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdmin_TypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin_Type  $admin_Type
     * @return \Illuminate\Http\Response
     */
    public function show(Admin_Type $admin_Type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin_Type  $admin_Type
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin_Type $admin_Type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdmin_TypeRequest  $request
     * @param  \App\Models\Admin_Type  $admin_Type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdmin_TypeRequest $request, Admin_Type $admin_Type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin_Type  $admin_Type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin_Type $admin_Type)
    {
        //
    }
}
