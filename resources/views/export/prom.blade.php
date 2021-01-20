<table>
    <thead>
    <tr>
        <th>Alumno</th>
        @foreach($units as $unit)
            <th>{{$unit->name}}</th>
        @endforeach
        <th>Promedio</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <?php
        $data = [];

        ?>
        <tr>
            <td>{{ $student->names.' '.$student->last_names }}</td>
        @foreach($units as $unit)
            <td>

                <?php
                $sum = \Illuminate\Support\Facades\DB::table('activities')->where('unit_id', $unit->id)
                    ->join('activities_students', 'activities.id', '=', 'activities_students.activity_id')
                    ->where('activities_students.student_id', '=', $student->id)
                    ->sum('activities_students.points');
                $count = \Illuminate\Support\Facades\DB::table('activities')->where('unit_id', $unit->id)
                    ->join('activities_students', 'activities.id', '=', 'activities_students.activity_id')
                    ->where('activities_students.student_id', '=', $student->id)
                    ->count('activities_students.id');

                $res = 0;
                if ($sum > 0 && $count > 0) {
                    $res = (($sum / $count) * $unit->max_points) / 100;
                } else {
                    $res = 0;
                }


                array_push($data, $res);

                ?>


                {{$res}}

            </td>

        @endforeach

            <td>
                <?php
                $s = array_sum($data);
                ?>
                Promedio: {{$s / sizeof($matter->units)}}
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
