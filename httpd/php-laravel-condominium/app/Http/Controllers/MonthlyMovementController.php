<?php

namespace App\Http\Controllers;

use App\GeneralSettings;
use App\Models\MonthlyMovement;
use App\Http\Requests\MonthlyMovement\{
    StoreMonthlyMovementRequest,
    UpdateMonthlyMovementRequest
};
use App\Http\Services\MonthlyMovement\{
    IndexMonthlyMovementService,
    ShowMonthlyMovementService,
    CreateMonthlyMovementService,
    StoreMonthlyMovementService,
    EditMonthlyMovementService,
    UpdateMonthlyMovementService,
    DestroyMonthlyMovementService
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

class MonthlyMovementController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, GeneralSettings $settings): Response
    {
        return IndexMonthlyMovementService::execute($request, $settings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Response
    {
      return CreateMonthlyMovementService::execute();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMonthlyMovementRequest $request): JsonResponse
    {
        return StoreMonthlyMovementService::execute($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MonthlyMovement  $monthlyMovement
     * @return \Illuminate\Http\Response
     */
    public function show(MonthlyMovement $monthlyMovement): Response
    {
        return ShowMonthlyMovementService::execute($monthlyMovement);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MonthlyMovement  $monthlyMovement
     * @return \Illuminate\Http\Response
     */    
    public function edit(MonthlyMovement $monthlyMovement): Response
    {
        return EditMonthlyMovementService::execute($monthlyMovement); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MonthlyMovement  $monthlyMovement
     * @return \Illuminate\Http\Response
     */
    public function update(MonthlyMovement $monthlyMovement, UpdateMonthlyMovementRequest $request): JsonResponse
    {        
        return UpdateMonthlyMovementService::execute($monthlyMovement, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MonthlyMovement  $monthlyMovement
     * @return \Illuminate\Http\Response
     */
    public function destroy(MonthlyMovement $monthlyMovement): RedirectResponse
    {
        return DestroyMonthlyMovementService::execute($monthlyMovement);
    }}
