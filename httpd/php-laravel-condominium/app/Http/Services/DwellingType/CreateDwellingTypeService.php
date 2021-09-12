<?php

namespace App\Http\Services\DwellingType;

use App\GeneralSettings;
use Inertia\Inertia;

class CreateDwellingTypeService
{
    /**
     * Show the form for creating a new resource.
     *
     * @return : \Inertia\Response
     */
    static public function execute():\Inertia\Response
    {
        return Inertia::render("DwellingTypes/Create");    
    }

}