<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Matter;
use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MatterController extends Controller
{

    public function index(){

    }

    public function show($id){

    }

    public function create(){
        $periods = Period::all();
        $groups = Group::all();
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

        $matter = Matter::create($request->all());

        if ($matter != null){
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

}
