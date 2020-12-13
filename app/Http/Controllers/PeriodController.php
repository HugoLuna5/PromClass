<?php

namespace App\Http\Controllers;

use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PeriodController extends Controller
{

    public function index(){
        $periods = Period::paginate(50)->setPageName('periods');
        return view('period.index', compact('periods'));
    }

    public function show($id){

        $period = Period::find($id);

        if ($period != null){
            return view('period.show', compact('period'));
        }

        return abort(404);

    }

    public function create(){
        return view('period.create');
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(), [
            'start_date' => ['required'],
            'end_date' => ['required'],
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Todos los campos son requeridos: ' . $validator->errors(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $period = Period::create($request->all());

        if ($period != null){

            $notification = array(
                'message' => 'Periodo agregado exitosamente!',
                'alert-type' => 'success'
            );

            return Redirect::to('/periods')->with($notification);

        }



        $notification = array(
            'message' => 'Error al agregar el periodo',
            'alert-type' => 'error'
        );

        return Redirect::to('/periods')->with($notification);
    }


    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Todos los campos son requeridos: ' . $validator->errors(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $period = Period::find($request->id);

        if ($period != null){

            $period->start_date = $request->start_date;
            $period->end_date = $request->end_date;
            if ($period->update()){
                $notification = array(
                    'message' => 'Periodo actualizado exitosamente!',
                    'alert-type' => 'success'
                );

                return Redirect::to('/periods')->with($notification);
            }

        }


        $notification = array(
            'message' => 'Error al actualizar el periodo',
            'alert-type' => 'error'
        );

        return back()->with($notification);

    }

    public function delete($id){
        $period = Period::find($id);

        if ($period->delete()){
            $notification = array(
                'message' => 'Periodo eliminado exitosamente!',
                'alert-type' => 'success'
            );

            return Redirect::to('/periods')->with($notification);
        }

        return abort(404);

    }

}
