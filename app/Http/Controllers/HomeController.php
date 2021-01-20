<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Matter;
use App\Models\Period;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index(){
        $user_id = Auth::user()->id;
        $matters = Matter::where('user_id', $user_id)->paginate(50)->setPageName('matter');

        return view('home.index', compact('matters'));
    }


    public function showStudent($matter_id, $student_id){
        $matter = Matter::find($matter_id);
        $student = Student::find($student_id);



        return view('home.student', compact('student', 'matter'));
    }



}
