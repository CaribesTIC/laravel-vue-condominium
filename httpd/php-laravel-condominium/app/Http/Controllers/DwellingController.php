<?php

namespace App\Http\Controllers;

use App\GeneralSettings;
use App\Models\Dwelling;
use App\Http\Requests\Dwelling\{
    StoreDwellingRequest,
    UpdateDwellingRequest
};
use App\Http\Services\Dwelling\{
    IndexDwellingService,
    //ShowDwellingService,
    CreateDwellingService,
    StoreDwellingService,
    EditDwellingService,
    UpdateDwellingService,
    DestroyDwellingService
};
use Illuminate\Http\{
    RedirectResponse,
    Request,
    JsonResponse
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
    public function create(): Response
    {
      return CreateDwellingService::execute();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDwellingRequest $request): JsonResponse
    {
        return StoreDwellingService::execute($request);
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
    public function update(Dwelling $dwelling, UpdateDwellingRequest $request): JsonResponse
    {        
        return UpdateDwellingService::execute($dwelling, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dwelling  $dwelling
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dwelling $dwelling): RedirectResponse
    {
        return DestroyDwellingService::execute($dwelling);
    }
}
