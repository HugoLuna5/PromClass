<?php

namespace App\Exports;

use App\Models\Matter;
use App\Models\Student;
use App\Models\Unit;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class PromExport implements FromView
{
    public $matter_id = null;



    /**
     * PromExport constructor.
     * @param null $matter_id
     */
    public function __construct($matter_id)
    {
        $this->matter_id = $matter_id;
    }


    public function view(): View
    {
        $matter = Matter::find($this->matter_id);
        $students = Student::where('group_id', $matter->group_id)->get();
        $units = Unit::where('matter_id', $matter->id)->get();
        return view('export.prom', compact('matter', 'students', 'units'));
    }
}
