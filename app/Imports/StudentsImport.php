<?php

namespace App\Imports;

use App\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentsImport implements ToCollection
{

    public $group_id = 0;

    /**
     * StudentsImport constructor.
     * @param int $group_id
     */
    public function __construct(int $group_id)
    {
        $this->group_id = $group_id;
    }


    public function collection(Collection $rows)

    {
        $i = 0;
        foreach ($rows as $row)
        {
            if ($i >= 3){
                \App\Models\Student::create([
                    'group_id' => $this->group_id,
                    'names' => $row[1],
                    'last_names' => $row[0],
                    'email' => $row[2]

                ]);
            }
            $i++;
        }


    }
}
