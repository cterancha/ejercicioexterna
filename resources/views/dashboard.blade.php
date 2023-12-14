<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Título</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Fecha vencimiento</th>
                        <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lista["items"] as $index=>$row)
                            <td>{{$index}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->titulo}}</td>
                            <td>{{$row->descripcion}}</td>
                            <td>{{$row->fechavencimiento}}</td>
                            <td>{{$row->descripcion_estado}}</td>
                        @endforeach
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
