<?php

namespace App\Http\Controllers;

use App\GeneralSettings;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GeneralSettingsController extends Controller
{
    function edit(GeneralSettings $settings)
    {
        return Inertia::render("Settings/Edit", [
            "footer_message" => $settings->footer_message,
        ]);
    }
    function update(Request $request, GeneralSettings $settings)
    {
        $data = $request->validate([
            "footer_message" => "required",
        ]);

        $settings->footer_message = $data["footer_message"];
        $settings->save();
        return redirect()
            ->route("settings.edit")
            ->with("success", "Ajustes guardados");
    }
}
