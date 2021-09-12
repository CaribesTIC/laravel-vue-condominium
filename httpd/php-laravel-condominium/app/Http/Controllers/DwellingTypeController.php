<?php

namespace App\Http\Controllers;

use App\Models\DwellingType;
use App\GeneralSettings;
use Illuminate\Http\{
    Request,
    RedirectResponse
};
use Inertia\{
    Inertia,
    Response
};
use App\Http\Services\DwellingType\{
    IndexDwellingTypeService,
    ShowDwellingTypeService,
    CreateDwellingTypeService,
    StoreDwellingTypeService,
    EditDwellingTypeService,
    UpdateDwellingTypeService,
    DestroyDwellingTypeService,
};


class DwellingTypeController extends Controller
{

    public function index(Request $request, GeneralSettings $settings): Response
    {
        return IndexDwellingTypeService::execute($request, $settings);
    }

    public function show(DwellingType $dwellingType): Response
    {
        return ShowDwellingTypeService::execute($dwellingType);
    }

    public function create():Response
    {
        return CreateDwellingTypeService::execute();   
    }

    public function store(Request $request): RedirectResponse
    {
        return StoreDwellingTypeService::execute($request);
    }

    public function edit(DwellingType $dwellingType): Response
    {
        return EditDwellingTypeService::execute($dwellingType);
    }

    public function update(Request $request, DwellingType $dwellingType): RedirectResponse
    {
        return UpdateDwellingTypeService::execute($request, $dwellingType);
    }

    public function destroy(DwellingType $dwellingType): RedirectResponse
    {
        DestroyDwellingTypeService::execute($dwellingType);
    }

}
