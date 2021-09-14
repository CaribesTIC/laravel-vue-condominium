<?php
namespace App\Http\Services\Dwelling;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests\Dewelling\UpdateDwellingRequest;
use App\Models\Dwelling;

class UpdateDwellingService
{

    static public function execute(UpdateDwellingRequest $request, $id)//: \Illuminate\Http\RedirectResponse
    {

        $dwelling = Dwelling::findOrFail($id);
	$dwelling->update($request->toArray()); 
        return response()->json(["success" => "Vivienda actualizada."], 201);

    }

}
