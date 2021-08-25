<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeneralSettings;
use Inertia\Inertia;
use App\Models\Dwelling;

class DwellingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dwelling  $dwelling
     * @return \Illuminate\Http\Response
     */
    public function show(Dwelling $dwelling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dwelling  $dwelling
     * @return \Illuminate\Http\Response
     */
    public function edit(Dwelling $dwelling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dwelling  $dwelling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dwelling $dwelling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dwelling  $dwelling
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dwelling $dwelling)
    {
        //
    }
}
