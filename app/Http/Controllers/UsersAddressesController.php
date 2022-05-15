<?php

namespace App\Http\Controllers;

use App\Models\users_addresses;
use App\Http\Requests\Storeusers_addressesRequest;
use App\Http\Requests\Updateusers_addressesRequest;

class UsersAddressesController extends Controller
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
     * @param  \App\Http\Requests\Storeusers_addressesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeusers_addressesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\users_addresses  $users_addresses
     * @return \Illuminate\Http\Response
     */
    public function show(users_addresses $users_addresses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\users_addresses  $users_addresses
     * @return \Illuminate\Http\Response
     */
    public function edit(users_addresses $users_addresses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateusers_addressesRequest  $request
     * @param  \App\Models\users_addresses  $users_addresses
     * @return \Illuminate\Http\Response
     */
    public function update(Updateusers_addressesRequest $request, users_addresses $users_addresses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\users_addresses  $users_addresses
     * @return \Illuminate\Http\Response
     */
    public function destroy(users_addresses $users_addresses)
    {
        //
    }
}
