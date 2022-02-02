<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoredookRequest;
use App\Http\Requests\UpdatedookRequest;
use App\Models\dook;

class DookController extends Controller
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
     * @param  \App\Http\Requests\StoredookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoredookRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dook  $dook
     * @return \Illuminate\Http\Response
     */
    public function show(dook $dook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dook  $dook
     * @return \Illuminate\Http\Response
     */
    public function edit(dook $dook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatedookRequest  $request
     * @param  \App\Models\dook  $dook
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedookRequest $request, dook $dook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dook  $dook
     * @return \Illuminate\Http\Response
     */
    public function destroy(dook $dook)
    {
        //
    }
}
