<?php

namespace App\Http\Controllers;

use App\Imports\ActivityImport;
use App\Imports\StudentsImport;
use App\Models\Group;
use App\Models\Matter;
use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Excel;

class ActivityController extends Controller
{
    //
    public function add($id){
        $matter  = Matter::find($id);
        if ($matter != null){

            return view('activity.create', compact( 'matter'));
        }

        return abort(404);

    }

    public function load(Request $request){
        $validator = Validator::make($request->all(), [
            'matter_id' => ['required'],
            'file' => ['required'],
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Todos los campos son requeridos: ' . $validator->errors(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $matter  = Matter::find($request->id);
        if ($matter != null){
            $res = Excel::import(new ActivityImport($matter->id,$matter->period_id), $request->file);
            $notification = array(
                'message' => 'Actividades agregadas exitosamente!',
                'alert-type' => 'success'
            );

            return Redirect::to('/matters/show/'.$matter->id)->with($notification);
        }


        $notification = array(
            'message' => 'Error al agregar las actividades',
            'alert-type' => 'error'
        );

        return Redirect::to('/home')->with($notification);

    }

}
