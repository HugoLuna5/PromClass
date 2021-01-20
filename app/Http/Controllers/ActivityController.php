<?php

namespace App\Http\Controllers;

use App\Imports\ActivityImport;
use App\Imports\StudentsImport;
use App\Models\ActivitiesStudent;
use App\Models\Activity;
use App\Models\Group;
use App\Models\Matter;
use App\Models\Period;
use App\Models\Unit;
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

    public function updateUnit(Request $request){
        $activity = Activity::find($request->pk);
        $activity->unit_id = $request->value;
        $activity->update();
        return response()->json(['status' => 'success', 'message' => 'Valor actualizado correctamente'], 200);
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
        $students = $matter->students;
        if ($matter != null){
            $res = Excel::import(new ActivityImport($matter->id,$matter->period_id, $students), $request->file);
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

    public function show($id, $activity){
        $matter  = Matter::find($id);
        $activity = Activity::find($activity);
        if ($matter != null && $activity != null){
            return view('activity.show', compact( 'matter', 'activity'));
        }

        return abort(404);
    }

    public function showActivity($matter_id, $activity_id){
        $matter  = Matter::find($matter_id);
        $activity = Activity::find($activity_id);

        if ($matter != null && $activity != null)
            return view('activity.student', compact('activity', 'matter'));

        abort(404);
    }


    public function updateCalActivity(Request $request){
        $unit = ActivitiesStudent::find($request->pk);
        $unit->points = $request->value;
        $unit->update();
        return response()->json(['status' => 'success', 'message' => 'Valor actualizado correctamente'], 200);
    }

}
