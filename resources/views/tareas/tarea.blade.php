<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }} 
            <button type="button" class="btn btn-outline-primary" onclick="nuevaEdicionTarea(0)">Nuevo</button>
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
                        <th scope="col">Acciones</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Título</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Fecha vencimiento</th>
                        <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lista["items"] as $index=>$row)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>
                                <a href="#" onclick="nuevaEdicionTarea({{$row->idtarea}})">Editar</a>
                                <a href="#" onclick="elimiar({{$row->idtarea}})">Eliminar</a>
                            </td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->titulo}}</td>
                            <td>{{$row->descripcion}}</td>
                            <td>{{$row->fechavencimiento}}</td>
                            <td>{{$row->descripcion_estado}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva tarea</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="idtarea">
            <div class="mb-3">
                <label for="txtTitulo" class="form-label">Titulo</label>
                <input type="text" class="form-control" id="txtTitulo" >
            </div>
            <div class="mb-3">
                <label for="txtDescripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="txtDescripcion" >
            </div>
            <div class="mb-3">
                <label for="dtbFechaVencimiento" class="form-label">Fecha vencimiento</label>
                <input type="text" class="form-control" id="dtbFechaVencimiento" >
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-outline-primary" onclick="guardarEditarTarea()">Guardar</button>
        </div>
        </div>
    </div>
    </div>

</x-app-layout>
