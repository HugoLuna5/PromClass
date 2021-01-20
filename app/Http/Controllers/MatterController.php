<?php

namespace App\Http\Controllers;

use App\Exports\PromExport;
use App\Models\Group;
use App\Models\Matter;
use App\Models\Period;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Excel;
use Illuminate\Support\Str;


class MatterController extends Controller
{

    public function index(){

    }

    public function show($id){

        $matter  = Matter::find($id);
        if ($matter != null){
            $periods = Period::all();
            $groups = Group::all();
            return view('home.show', compact('periods', 'groups', 'matter'));
        }

        return abort(404);
    }

    public function create(){
        $user_id = Auth::user()->id;
        $periods = Period::where('user_id', $user_id)->get();
        $groups = Group::where('user_id', $user_id)->get();
        return view('home.create', compact('periods', 'groups'));
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'max_units' => ['required'],
            'period_id' => ['required'],
            'group_id' => ['required'],
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Todos los campos son requeridos: ' . $validator->errors(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $user_id = Auth::user()->id;
        $request['user_id'] = $user_id;
        $matter = Matter::create($request->all());

        if ($matter != null){

            for ($i=0; $i < $request->max_units; $i++){
                Unit::create([
                    'user_id' => $user_id,
                   'name' => 'Unidad '.($i+1),
                   'matter_id' => $matter->id
                ]);
            }

            $notification = array(
                'message' => 'Materia agregada exitosamente!',
                'alert-type' => 'success'
            );

            return Redirect::to('/home')->with($notification);
        }
        $notification = array(
            'message' => 'Error al agregar la materia',
            'alert-type' => 'error'
        );

        return Redirect::to('/home')->with($notification);

    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'period_id' => ['required'],
            'group_id' => ['required'],
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Todos los campos son requeridos: ' . $validator->errors(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $matter = Matter::find($request->matter_id);


        if ($matter != null){

            $matter->name = $request->name;
            $matter->period_id = $request->period_id;
            $matter->group_id = $request->group_id;

            if ($matter->update()){
                $notification = array(
                    'message' => 'Materia actualizada exitosamente!',
                    'alert-type' => 'success'
                );

                return Redirect::to('/matters/show/'.$matter->id)->with($notification);
            }

        }

        $notification = array(
            'message' => 'Error al actualizar la materia',
            'alert-type' => 'error'
        );

        return Redirect::to('/matters/show/'.$matter->id)->with($notification);


    }


    public function export($matter_id){
        $matter = Matter::find($matter_id);

        $prom = Str::upper(Carbon::parse($matter->period->start_date)->isoFormat(' D MMM')).' - '.Str::upper(Carbon::parse($matter->period->end_date)->isoFormat(' D MMM'));
        return Excel::download(new PromExport($matter_id), $matter->name.' - Promedios - '.$prom.'.xlsx');
    }

}
