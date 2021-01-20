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

                            <form class="w-full max-w-lg " method="POST" action="{{route('updateMatter')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{$matter->id}}" name="matter_id">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-password">
                                            Nombre
                                        </label>
                                        <input value="{{$matter->name}}" name="name" required
                                               class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                               type="text">
                                    </div>
                                </div>

                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-password">
                                            Periodo
                                        </label>
                                        <select name="period_id" id="period_id" required
                                                class=" block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                            @foreach($periods as $period)
                                                @if($period->id == $matter->period_id)
                                                    <option selected
                                                            value="{{$period->id}}">{{\Illuminate\Support\Str::upper(Carbon\Carbon::parse($period->start_date)->isoFormat(' D MMM'))}}
                                                        - {{\Illuminate\Support\Str::upper(Carbon\Carbon::parse($period->end_date)->isoFormat(' D MMM'))}}</option>
                                                @else
                                                    <option
                                                        value="{{$period->id}}">{{\Illuminate\Support\Str::upper(Carbon\Carbon::parse($period->start_date)->isoFormat(' D MMM'))}}
                                                        - {{\Illuminate\Support\Str::upper(Carbon\Carbon::parse($period->end_date)->isoFormat(' D MMM'))}}</option>
                                                @endif
                                            @endforeach
                                        </select>


                                    </div>
                                </div>

                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-password">
                                            Grupo
                                        </label>
                                        <select name="group_id" id="group_id" required
                                                class=" block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                            @foreach($groups as $group)
                                                @if($group->id == $matter->group_id)
                                                    <option selected value="{{$group->id}}">{{$group->name}} -
                                                        Alumnos({{$group->students->count()}}) -
                                                        ({{\Illuminate\Support\Str::upper(Carbon\Carbon::parse($group->period->start_date)->isoFormat(' D MMM'))}}
                                                        - {{\Illuminate\Support\Str::upper(Carbon\Carbon::parse($group->period->end_date)->isoFormat(' D MMM'))}}
                                                        )
                                                    </option>
                                                @else
                                                    <option value="{{$group->id}}">{{$group->name}} -
                                                        Alumnos({{$group->students->count()}}) -
                                                        ({{\Illuminate\Support\Str::upper(Carbon\Carbon::parse($group->period->start_date)->isoFormat(' D MMM'))}}
                                                        - {{\Illuminate\Support\Str::upper(Carbon\Carbon::parse($group->period->end_date)->isoFormat(' D MMM'))}}
                                                        )
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>


                                    </div>
                                </div>


                                <div class="md:flex justify-center">
                                    <button
                                        class="shadow bg-teal-400 hover:bg-teal-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-12 rounded"
                                        type="submit">
                                        Actualizar
                                    </button>
                                </div>
                            </form>

                        </div>

                        <!--units-->
                        <div
                            class="mt-6 rounded-tl-lg rounded-tr-lg overflow-hidden bg-white shadow-lg align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard pt-3 px-8 rounded-bl-lg rounded-br-lg">
                            <div class="flex justify-end ">
                                <a role="button"
                                   class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2  border rounded-full"
                                   href="{{route('createUnit', ['id' => $matter->id])}}">
                                    Agregar unidad
                                </a>
                            </div>
                            <table class="min-w-full">
                                <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                        Nombre
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                                        Puntos
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="bg-white">
                                @foreach($matter->units as $unit)

                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                            <div class="flex items-center">
                                                <div>
                                                    <div class="text-sm leading-5 text-gray-800">
                                                        <a href="{{route('showUnit', ['id' => $matter->id,'unit_id' => $unit->id])}}">

                                                        {{$unit->name}}
                                                        </a></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                            <div class="text-sm leading-5 text-blue-900">
                                                <a href="#"
                                                   data-type="text"
                                                   data-pk="{{$unit->id}}"
                                                   data-url="{{route('updateUnit')}}"
                                                   data-title="Points"
                                                   data-value="{{$unit->max_points}}"
                                                   class="set-points text-gray-900 whitespace-no-wrap"
                                                   data-name="points"></a>

                                            </div>
                                        </td>

                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                            <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between mt-4 work-sans">
                                <div>

                                </div>
                                <div class="mb-6">
                                </div>
                            </div>
                        </div>

                    </div>


                </div>


                <div class="mx-auto w-2/3 justify-center m-5">
                    <div
                        class="align-middle rounded-tl-lg rounded-tr-lg inline-block w-full py-4 overflow-hidden bg-white shadow-lg px-12">
                        <div class="flex justify-end ">
                            <a role="button"
                               class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2  border rounded-full"
                               href="{{route('addActivity', ['id' => $matter->id])}}">
                                Agregar actividades
                            </a>
                        </div>
                    </div>
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
                        <table class="min-w-full">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    Nombre
                                </th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                                    Puntos
                                </th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider text-center">
                                    Unidad
                                </th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                                    Fecha
                                </th>
                                <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @foreach($matter->activities as $activity)

                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm leading-5 text-gray-800">
                                                    <p data-title='{{$activity->name}}' data-placement="top">{{ \Illuminate\Support\Str::limit($activity->name, 25, $end='...') }}</p>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 text-blue-900">{{$activity->points}}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm text-center leading-5 text-blue-900">
                                            <a href="#"
                                               id="status"
                                               data-type="select"
                                               data-pk="{{$activity->id}}"
                                               data-url="{{route('updateActivityUnit', ['id' => $matter->id])}}"
                                               class="set-status"
                                               data-value="{{$activity->unit_id}}"
                                               data-title="Unidad"></a>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 text-blue-900">{{$activity->date_created}}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                        <a class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none"
                                           href="{{route('showActivity', ['id' => $matter->id,'activity' => $activity->id])}}">Ver detalles</a>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                        <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between mt-4 work-sans">
                            <div>

                            </div>
                            <div class="mb-6">
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="flex justify-center">
                <div class="w-1/3"></div>

                <div class="mx-auto w-2/3 justify-center ">
                    <div
                        class="align-middle rounded-tl-lg rounded-tr-lg inline-block w-full py-4 overflow-hidden bg-white shadow-lg px-12">
                        <div class="  ">
                            <div>
                                <h1 class="text-lg">
                                    <b>Alumnos</b>
                                </h1>
                            </div>


                            <div class="flex justify-end ">
                                <a role="button"
                                   class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2  border rounded-full"
                                   href="">
                                    Exportar datos
                                </a>
                            </div>
                        </div>

                    </div>
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
                        <table class="min-w-full">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                                    Nombre
                                </th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                                    Agregado
                                </th>
                                <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @foreach($matter->students as $student)

                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm leading-5 text-gray-800">
                                                    <p >{{$student->names.' '.$student->last_names}}</p>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 text-blue-900">{{$activity->created_at}}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                        <a class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none"
                                           href="{{route('showStudent', [$matter->id, $student->id])}}">Ver detalles</a>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                        <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between mt-4 work-sans">
                            <div>

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
