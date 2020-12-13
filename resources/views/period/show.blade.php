@extends('layouts.new')

@section('content')

    <main>
        <div class="py-12 ">
            <div class="flex justify-center bg-grey-lighter">
                <form class="w-full max-w-lg" method="POST" action="{{route('updatePeriod')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$period->id}}">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Inicio
                            </label>
                            <input name="start_date" value="{{$period->start_date}}" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="date" >
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Fin
                            </label>
                            <input name="end_date" value="{{$period->end_date}}" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="date" >
                        </div>
                    </div>


                    <div class="md:flex md:items-center">
                        <div class="md:w-1/3">
                        </div>
                        <div class="md:w-2/3">
                            <button class="shadow bg-teal-400 hover:bg-teal-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-12 rounded" type="submit">
                                Actualizar
                            </button>
                        </div>
                        <div class="md:w-3/3">
                            <a href="{{route('deletePeriod', ['id' => $period->id])}}" class="shadow bg-red-400 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-12 rounded" >
                                Eliminar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>


@endsection
