@extends('layouts.new')

@section('content')
    <link href="{{asset('/xeditable/css/app.css')}}" rel="stylesheet"/>
    <link href="{{asset('/xeditable/css/edit.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('fonts/feather/feather.min.css')}}">
    <main class="flex justify-center ">
        <div class="py-12 w-12/12 ">
            <div class="flex justify-center">
                @extends('layouts.alerts')



                <div class="mx-auto w-3/3 justify-center m-5">
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
                                    #
                                </th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    Alumno
                                </th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                                    Puntos
                                </th>


                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            <?php
                                $i=1;
                                ?>
                            @foreach($activity->activities as $actStudent)

                                <tr>
                                    <td>{{$i}}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm leading-5 text-gray-800">{{$actStudent->student->names.' '.$actStudent->student->last_names}}</div>
                                            </div>
                                        </div>
                                    </td>


                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm text-center leading-5 text-blue-900">
                                            <a href="#"
                                               data-type="text"
                                               data-pk="{{$actStudent->id}}"
                                               data-url="{{route('updateCalActivity',[$activity->matter_id, $activity->id])}}"
                                               data-title="Points"
                                               data-value="{{$actStudent->points}}"
                                               class="set-points text-gray-900 whitespace-no-wrap"
                                               data-name="points"></a>
                                        </div>
                                    </td>




                                </tr>
                                <?php
                                $i++;
                                ?>
                            @endforeach

                            </tbody>
                        </table>
                        <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between mt-4 work-sans">
                            <div class="m-5 justify-end items-end float-right">


                            </div>
                            <div class="mb-6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
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



        });
    </script>
@endsection
