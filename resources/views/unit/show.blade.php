@extends('layouts.new')

@section('content')

    <main>
        <div class="py-12 ">
            @extends('layouts.alerts')
            <div class="flex justify-center bg-grey-lighter">


                <form class="w-full max-w-lg" method="POST" action="{{route('updateUnitCompleted', [$matter->id])}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                    <input type="hidden" name="matter_id" value="{{$matter->id}}">
                    <input type="hidden" name="unit_id" value="{{$unit->id}}">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                Nombre
                            </label>
                            <input value="{{$unit->name}}" name="name" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text">
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                Puntos
                            </label>
                            <input value="{{$unit->max_points}}" name="max_points" aria-valuemax="100" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="number">
                        </div>
                    </div>





                    <div class="md:flex md:items-center">
                        <div class="md:w-1/3">
                        </div>
                        <div class="md:w-2/3">
                            <button id="btnDelete" class="shadow bg-red-600 hover:bg-red-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-12 rounded" type="button">
                                Eliminar
                            </button>
                        </div>
                        <div class="md:w-3/3">
                            <button class="shadow bg-teal-400 hover:bg-teal-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-12 rounded" type="submit">
                                Actualizar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        const tokenWb = $('meta[name="csrf-token"]').attr('content');//token de seguridad

        let btnDelete = document.getElementById('btnDelete');
        btnDelete.addEventListener('click', function (event) {
            event.preventDefault()
            const options = {
                method: 'POST',
                body: JSON.stringify({
                    'unit_id': '{{$unit->id}}',
                }),
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': tokenWb
                }
            };


            fetch('{{route('deleteUnit', [$matter->id])}}', options)
                .then((res) => res.json())
                .then((res) => {

                    if (res.status === 'success'){
                        location.href = '/matters/show/{{$matter->id}}'
                    }else{
                        alert(res.message)
                    }
                });
        });

    </script>

@endsection
