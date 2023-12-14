<h1>EJERCICIO EXTERNA</h1>

El ejercicio está en una arquitectura ordenada y simple de trabajar con el reuso de código tanto para web como api.
<br><br>
<b>Consideraciones por tiempo:</b><br>
1.	No logré hacer las validaciones de ingreso de datos: a nivel de frontend, controlador y modelo (recomiendo hacer las validaciones por lo menos en el Frontend y controlador) 
2.	Las APIs no están autentificacas y dejé una demo de como podría trabajarse pero las web con blade si está debidamente autentificado
3.	Ya no consideré el estado en el CRUD
<br><br>

<b>Documentación endpoints:</b>
1. setTarea
    http://localhost:8000/api/awt/crud/deleteTarea
    parametros:
       txtTitulo
       txtDescripcion
       dtbFechaVencimiento

2. modifyTarea
    http://localhost:8000/api/awt/crud/modifyTarea
    parametros:
       idtarea
       txtTitulo
       txtDescripcion
       dtbFechaVencimiento

3. deleteTarea
    http://localhost:8000/api/awt/crud/deleteTarea
    parametros:
       idtarea
   
