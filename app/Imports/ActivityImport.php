<?php

namespace App\Imports;

use App\Models\Activity;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ActivityImport implements ToCollection
{
    public $matter_id = null;
    public $period_id = null;

    /**
     * ActivityImport constructor.
     * @param null $matter_id
     * @param null $period_id
     */
    public function __construct($matter_id, $period_id)
    {
        $this->matter_id = $matter_id;
        $this->period_id = $period_id;
    }


    public function collection(Collection $rows)
    {

        $names = $rows[0];
        $dates = $rows[1];
        $points = $rows[2];

        for($i=3; $i < sizeof($rows[0]); $i++){
            Activity::create([
                'matter_id' => $this->matter_id,
                'period_id' => $this->period_id,
                'name' => $names[$i],
                'date_created' => $dates[$i],
                'points' => $points[$i]
            ]);
        }

    }
}
