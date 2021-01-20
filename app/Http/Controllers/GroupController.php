<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use App\Models\Group;
use App\Models\Period;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    //
    public function index(){
        $groups = Group::paginate(50)->setPageName('groups');
        return view('group.index', compact('groups'));
    }

    public function show($id){
        $group = Group::find($id);
        if ($group != null){
            $periods = Period::all();
            return view('group.show', compact('group', 'periods'));
        }

        return abort(404);

    }

    public function create(){
        $periods = Period::all();
        return view('group.create', compact('periods'));
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'period_id' => ['required'],
            'file' => ['required'],
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Todos los campos son requeridos: ' . $validator->errors(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        $request['user_id'] = Auth::user()->id;
        $group = Group::create($request->all());

        if ($group != null){
            $res = Excel::import(new StudentsImport(1), $request->file);
            $notification = array(
                'message' => 'Grupo agregado exitosamente!',
                'alert-type' => 'success'
            );

            return Redirect::to('/groups')->with($notification);
        }




        $notification = array(
            'message' => 'Error al agregar el grupo',
            'alert-type' => 'error'
        );

        return Redirect::to('/periods')->with($notification);
    }

    public function update(Request $request){

    }

}
