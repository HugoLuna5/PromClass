<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Matter;
use App\Models\Period;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(){
        $matters = Matter::paginate(50)->setPageName('matter');
        return view('home.index', compact('matters'));
    }




}
