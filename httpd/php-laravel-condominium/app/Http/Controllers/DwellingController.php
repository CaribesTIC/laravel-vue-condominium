<?php

namespace App\Http\Controllers;

use App\GeneralSettings;
use App\Models\Dwelling;
use App\Http\Services\Dwelling\{
    IndexDwellingService,
    //ShowDwellingService,
    //CreateDwellingService,
    //StoreDwellingService,
    EditDwellingService,
    UpdateDwellingService,
    //DestroyDwellingService
};
use Illuminate\Http\{
    Request,
    RedirectResponse
};
use Inertia\{
    Inertia,
    Response
};

class DwellingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, GeneralSettings $settings): Response
    {
        return IndexDwellingService::execute($request, $settings);
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
    public function edit(Dwelling $dwelling): Response
    {
        return EditDwellingService::execute($dwelling); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dwelling  $dwelling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//: RedirectResponse
    {        
        return UpdateDwellingService::execute($request, $id);
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
