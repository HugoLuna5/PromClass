<?php

namespace App\Imports;

use App\Models\ActivitiesStudent;
use App\Models\Activity;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ActivityImport implements ToCollection
{
    public $matter_id = null;
    public $period_id = null;
    public $students = null;

    /**
     * ActivityImport constructor.
     * @param null $matter_id
     * @param null $period_id
     */
    public function __construct($matter_id, $period_id, $students)
    {
        $this->matter_id = $matter_id;
        $this->period_id = $period_id;
        $this->students = $students;
    }


    public function collection(Collection $rows)
    {

        $names = $rows[0];
        $dates = $rows[1];
        $points = $rows[2];


        for($i=3; $i < sizeof($rows[0]); $i++){
            $act = Activity::create([
                'matter_id' => $this->matter_id,
                'period_id' => $this->period_id,
                'name' => $names[$i],
                'date_created' => $dates[$i],
                'points' => $points[$i]
            ]);

            for($j=3; $j <sizeof($this->students); $j++){
                //ActivityStudent
                ActivitiesStudent::create([
                    'matter_id' => $this->matter_id,
                    'student_id' => $this->students[$j]->id,
                    'points' => $rows[$j][$i],
                    'activity_id' => $act->id
                ]);
            }

        }

    }
}
