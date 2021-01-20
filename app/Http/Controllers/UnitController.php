<?php

namespace App\Http\Controllers;

use App\Models\Matter;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    //



    public function create($id)
    {
        $matter = Matter::find($id);


        return view('unit.create', compact('matter'));
    }

    public function save($matter_id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Todos los campos son requeridos: ' . $validator->errors(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        $matter = Matter::find($matter_id);


        if ($matter_id != null) {
            $unit = Unit::create($request->all());
            if ($unit != null) {

                $matter->max_units = $matter->max_units + 1;
                $matter->update();

                $notification = array(
                    'message' => 'Unidad agregada exitosamente!',
                    'alert-type' => 'success'
                );

                return Redirect::to('/matters/show/' . $matter->id)->with($notification);

            }


        }

        $notification = array(
            'message' => 'Error al agregar la unidad',
            'alert-type' => 'error'
        );

        return Redirect::to('/matters/show/' . $matter->id)->with($notification);

    }


    public function show($id, $unit_id)
    {
        $matter = Matter::find($id);
        $unit = Unit::find($unit_id);

        if ($unit != null) {
            return view('unit.show', compact('matter', 'unit'));
        }
        abort(404);


    }

    public function update(Request $request)
    {
        $unit = Unit::find($request->pk);
        $unit->max_points = $request->value;
        $unit->update();
        return response()->json(['status' => 'success', 'message' => 'Valor actualizado correctamente'], 200);
    }

    public function updateUnitCompleted(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'max_points' => ['required'],
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Todos los campos son requeridos: ' . $validator->errors(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $unit = Unit::find($request->unit_id);

        if ($unit != null){

            $unit->name = $request->name;
            $unit->max_points = $request->max_points;

            if ($unit->update()){
                $notification = array(
                    'message' => 'Unidad actualizada exitosamente!',
                    'alert-type' => 'success'
                );

                return Redirect::to('/matters/show/' . $request->matter_id)->with($notification);
            }

        }

        $notification = array(
            'message' => 'Error al actualizar la unidad',
            'alert-type' => 'error'
        );

        return Redirect::to('/matters/show/' . $request->matter_id)->with($notification);

    }


    public function delete(Request $request){
        $unit = Unit::find($request->unit_id);

        if ($unit != null){
            DB::table('activities')->where('unit_id',  $unit->id)
                ->update(['unit_id' => null]);

            if ($unit->delete()){
                return response()->json(['status' => 'success', 'message' => 'Unidad eliminado correctamente'], 200);

            }


        }
            return response()->json(['status' => 'error', 'message' => 'Ocurrio un error al eliminar la unidad'], 200);




    }


}
