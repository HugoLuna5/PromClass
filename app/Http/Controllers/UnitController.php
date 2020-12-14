<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    //

    public function update(Request $request){
        $unit = Unit::find($request->pk);
        $unit->max_points = $request->value;
        $unit->update();
        return response()->json(['status' => 'success', 'message' => 'Valor actualizado correctamente'], 200);
    }

    public function show($id, $unit_id){

    }

}
