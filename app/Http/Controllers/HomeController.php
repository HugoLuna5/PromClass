<?php

namespace App\Http\Controllers;

use App\Models\Matter;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(){
        $matters = Matter::paginate(50)->setPageName('matter');
        return view('home.index', compact('matters'));
    }


}
