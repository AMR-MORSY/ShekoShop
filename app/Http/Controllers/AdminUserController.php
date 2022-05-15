<?php

namespace App\Http\Controllers;

use App\Models\Admin_User;
use App\Http\Requests\StoreAdmin_UserRequest;
use App\Http\Requests\UpdateAdmin_UserRequest;

class AdminUserController extends Controller
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
     * @param  \App\Http\Requests\StoreAdmin_UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdmin_UserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin_User  $admin_User
     * @return \Illuminate\Http\Response
     */
    public function show(Admin_User $admin_User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin_User  $admin_User
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin_User $admin_User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdmin_UserRequest  $request
     * @param  \App\Models\Admin_User  $admin_User
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdmin_UserRequest $request, Admin_User $admin_User)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin_User  $admin_User
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin_User $admin_User)
    {
        //
    }
}
