@extends('layouts.new')

@section('content')

    <main>
        <div class="py-12 ">
            <div class="flex justify-center bg-grey-lighter ">
                <form class="w-full max-w-lg rounded-tl-lg rounded-tr-lg overflow-hidden bg-white shadow-lg px-10 p-5" method="POST" action="{{route('loadActivities', ['id' => $matter->id])}}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="matter_id" value="{{$matter->id}}">

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                Archivo Excel
                            </label>
                            <input  name="file" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="file">

                        </div>
                    </div>


                    <div class="md:flex md:items-center">
                        <div class="md:w-1/3">
                        </div>
                        <div class="md:w-2/3"></div>
                        <div class="md:w-3/3">
                            <button class="shadow bg-teal-400 hover:bg-teal-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-12 rounded" type="submit">
                                Agregar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>


@endsection
