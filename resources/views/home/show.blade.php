@extends('layouts.new')

@section('content')
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <main class="flex justify-center ">
        <div class="py-12 w-10/12 ">
            <div class="flex justify-center">
                @extends('layouts.alerts')
                <div class="flex justify-center bg-grey-lighter w-1/3 m-5">
                    <form class="w-full max-w-lg py-4  rounded-tl-lg rounded-tr-lg overflow-hidden bg-white shadow-lg px-10" method="POST" action="{{route('saveMatter')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
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
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                       for="grid-password">
                                    Unidades
                                </label>
                                <input value="{{$matter->max_units}}" name="max_units" required
                                       class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                       type="number">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
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
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
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
                                                <div data-title='{{$activity->name}}' data-placement="top" class="text-sm leading-5 text-gray-800">{{ \Illuminate\Support\Str::limit($activity->name, 30, $end='...') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 text-blue-900">{{$activity->points}}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 text-blue-900">{{$activity->date_created}}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                        <a class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none" href="{{route('showGroup', ['id' => $activity->id])}}">Ver detalles</a>
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
        tippy('div', {
            content:(reference)=>reference.getAttribute('data-title'),
            onMount(instance) {
                instance.popperInstance.setOptions({
                    placement :instance.reference.getAttribute('data-placement')
                });
            }
        });
    </script>

@endsection
