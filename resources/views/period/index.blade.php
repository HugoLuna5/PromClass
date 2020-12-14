@extends('layouts.new')

@section('content')

    <main>
        <div class="py-12">
            @extends('layouts.alerts')
            <div class="max-w-4xl mx-auto sm:px-4 lg:px-6">
                <div class="align-middle rounded-tl-lg rounded-tr-lg inline-block w-full py-4 overflow-hidden bg-white shadow-lg px-12">
                    <div class="flex justify-end ">
                        <a role="button" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2  border rounded-full" href="{{route('createPeriod')}}">
                            Agregar periodo
                        </a>
                    </div>
                </div>
                        <div class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
                            <table class="min-w-full">
                                <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">ID</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Inicio</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Fin</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                                </tr>
                                </thead>
                                <tbody class="bg-white">
                                @foreach($periods as $period)

                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                            <div class="flex items-center">
                                                <div>
                                                    <div class="text-sm leading-5 text-gray-800">#{{$period->id}}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                            <div class="text-sm leading-5 text-blue-900">{{\Illuminate\Support\Str::upper(Carbon\Carbon::parse($period->start_date)->isoFormat(' D MMM'))}}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                            <div class="text-sm leading-5 text-blue-900">{{\Illuminate\Support\Str::upper(Carbon\Carbon::parse($period->end_date)->isoFormat(' D MMM'))}}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                            <a class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none" href="{{route('showPeriod', ['id' => $period->id])}}">Ver detalles</a>
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
        </div>
    </main>


@endsection
