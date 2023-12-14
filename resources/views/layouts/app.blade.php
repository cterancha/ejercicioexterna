<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            
            var url_consulta = "{{ url('/tareas/consultar') }}";
            var url_mantenimiento = "{{ url('/tareas/mantenimiento') }}";
            
            function nuevaEdicionTarea(idtarea){
                $('#idtarea').val(idtarea);
                $.ajax(url_consulta,{
                    type: "post",
                    beforeSend: function(){
                    },
                    complete: function(){                    
                    },
                    success: function(datos){
                        if (datos.length > 0){
                            $('#txtTitulo').val(datos[0].titulo);
                            $('#txtDescripcion').val(datos[0].descripcion);
                            $('#dtbFechaVencimiento').val(datos[0].fechavencimiento);
                        }
                    },
                    error:function(x,e){
                    },                      
                    data: {
                        _token:'<?= csrf_token() ?>'
                        ,_acc       : 'getTarea'
                        ,idtarea  : idtarea
                    },
                    async: true,
                    dataType: "json"
                });
                

                const myModal = new bootstrap.Modal('#exampleModal');
                myModal.show();
            }

            function guardarEditarTarea(){
                
                let idtarea = $('#idtarea').val();
                let txtTitulo = $('#txtTitulo').val();
                let txtDescripcion = $('#txtDescripcion').val();
                let dtbFechaVencimiento = $('#dtbFechaVencimiento').val();

                $.ajax(url_mantenimiento,{
                    type: "post",
                    beforeSend: function(){
                    },
                    complete: function(){                    
                    },
                    success: function(datos){
                        if (datos[0].o_nres == 1){
                            alert('Registro ok');
                            window.location.reload();
                        }else{
                            alert('Error:' + datos[0].o_msj);
                        }
                    },
                    error:function(x,e){
                    },                      
                    data: {
                        _token:'<?= csrf_token() ?>'
                        ,_acc       : 'guardar_editar'
                        ,idtarea  : idtarea
                        ,txtTitulo: txtTitulo
                        ,txtDescripcion: txtDescripcion
                        ,dtbFechaVencimiento: dtbFechaVencimiento
                    },
                    async: true,
                    dataType: "json"
                });
                

                const myModal = new bootstrap.Modal('#exampleModal');
                myModal.show();
            }

            function elimiar(idtarea){
                
                $.ajax(url_mantenimiento,{
                    type: "post",
                    beforeSend: function(){
                    },
                    complete: function(){                    
                    },
                    success: function(datos){
                        if (datos[0].o_nres == 1){
                            alert('Registro ok');
                            window.location.reload();
                        }else{
                            alert('Error:' + datos[0].o_msj);
                        }
                    },
                    error:function(x,e){
                    },                      
                    data: {
                        _token:'<?= csrf_token() ?>'
                        ,_acc       : 'eliminar'
                        ,idtarea  : idtarea
                    },
                    async: true,
                    dataType: "json"
                });
                
            }
        </script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
