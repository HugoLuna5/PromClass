<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
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
                Student::create([
                    'group_id' => $this->group_id,
                    'names' => Str::upper($row[1]),
                    'last_names' => Str::upper($row[0]),
                    'email' => $row[2]

                ]);
            }
            $i++;
        }


    }
}
