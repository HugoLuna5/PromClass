@extends('layouts.new')

@section('content')
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <link href="{{asset('/xeditable/css/app.css')}}" rel="stylesheet"/>
    <link href="{{asset('/xeditable/css/edit.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('fonts/feather/feather.min.css')}}">
    <main class="flex justify-center ">
        <div class="py-12 w-14/12 ">
            <div class="flex justify-center">
                @extends('layouts.alerts')
                <div class="flex justify-center bg-grey-lighter w-1/3 m-5">

                    <div id="mainCont" class="container">

                        <div class="py-4  rounded-tl-lg rounded-tr-lg overflow-hidden bg-white shadow-lg px-10">

                            <div class="w-full max-w-lg ">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-password">
                                            Nombre completo
                                        </label>
                                        <p>{{$student->names.' '.$student->last_names}}</p>
                                    </div>
                                    <div class="w-full px-3 mt-3">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-password">
                                            Grupo
                                        </label>
                                        <p>{{$student->group->name}}</p>
                                    </div>

                                    <div class="w-full px-3 mt-3">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-password">
                                            Materia
                                        </label>
                                        <p>{{$matter->name}}</p>
                                    </div>

                                    <div class="w-full px-3 mt-3">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-password">
                                            Periodo
                                        </label>
                                        <p>{{\Illuminate\Support\Str::upper(Carbon\Carbon::parse($matter->period->start_date)->isoFormat(' D MMM'))}}
                                            - {{\Illuminate\Support\Str::upper(Carbon\Carbon::parse($matter->period->end_date)->isoFormat(' D MMM'))}}</p>
                                    </div>
                                </div>

                            </div>

                        </div>


                    </div>


                </div>


                <div class="mx-auto w-2/3 justify-center m-5">
                    <div
                        class="align-middle rounded-tl-lg rounded-tr-lg inline-block w-full py-4 overflow-hidden bg-white shadow-lg px-12">
                        <div class="flex justify-end ">

                        </div>
                    </div>
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
                        <table class="min-w-full">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    Unidad
                                </th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider text-center">
                                    Calificacion Maxima
                                </th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider text-center">
                                    Calificacion
                                </th>


                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            <?php
                            $data = [];

                            ?>

                            @foreach($matter->units as $unit)

                                <tr>
                                    <td class="px-3 py-2 whitespace-no-wrap border-b border-gray-500">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm leading-5 text-gray-800 text-center">
                                                    <p>{{ $unit->name}}</p>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-2 whitespace-no-wrap border-b border-gray-500">
                                        <div
                                            class="text-sm leading-5 text-blue-900 text-center">{{$unit->max_points}}</div>
                                    </td>

                                    <td class="px-3 py-2 whitespace-no-wrap border-b border-gray-500 text-center">

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


                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                        <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between mt-4 work-sans">
                            <div>
                                <?php
                                $s = array_sum($data);
                                ?>
                                Promedio: {{$s / sizeof($matter->units)}}

                            </div>
                            <div class="mb-6">
                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </main>
    <script>
        tippy('p', {
            content: (reference) => reference.getAttribute('data-title'),
            onMount(instance) {
                instance.popperInstance.setOptions({
                    placement: instance.reference.getAttribute('data-placement')
                });
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{asset('/xeditable/js/app.js')}}"></script>
    <script>
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editable.defaults.ajaxOptions = {type: 'PUT'};
        $(document).ready(function () {
            var token = $('meta[name="csrf-token"]').attr('content');
            $(".set-points").editable({
                emptytext: 'No asignada',
                ajaxOptions: {
                    headers: {
                        'X-CSRF-TOKEN': token,
                    },
                    type: 'put',
                    dataType: 'json'
                },
                success: function (response, newValue) {
                    if (response.status === 'success') {
                        console.log("Success")
                    }
                }
            });

            $('.set-status').editable({
                emptytext: 'No asignada',
                title: 'Unidad',
                source: [
                        @foreach($matter->units as $unit)
                    {
                        value: {{$unit->id}}, text: '{{$unit->name}}'
                    },
                    @endforeach

                ],
                ajaxOptions: {
                    headers: {
                        'X-CSRF-TOKEN': token,
                    },
                    type: 'put',
                    dataType: 'json'
                },
                success: function (response, newValue) {
                    if (response.status === 'success') {
                        console.log("Success")
                    }
                }
            });

        });
    </script>
@endsection
