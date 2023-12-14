<?php

namespace App\Http\Controllers\Api;

//Requerido
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Model
use App\Models\Tarea;

class TareaController extends Controller
{
    
    public function __construct(){
    }
    public function setTarea(Request $request)
    {
        //Datos Generales
        $model   = new Tarea();
        $usuarioid = 1;//auth()->user()->id;
        $ip_maq = $request->ip();
        $info[0] = 1;
        $info[1] = $usuarioid;
        $info[2] = 0;
        $info[3] = is_null($request->input('txtTitulo')) ? '' : trim($request->input('txtTitulo'));
        $info[4] = is_null($request->input('txtDescripcion')) ? '' : trim($request->input('txtDescripcion'));
        $info[5] = is_null($request->input('dtbFechaVencimiento')) ? '' : trim($request->input('dtbFechaVencimiento'));
        $info[6] = $usuarioid;
        $info[7] = $ip_maq;

        $data   = $model->mantenimientoData($info);
        return response()->json($data, 200);
    }

    public function modifyTarea(Request $request)
    {
        //Datos Generales
        $model   = new Tarea();
        $usuarioid = 1;//auth()->user()->id;
        $ip_maq = $request->ip();
        $info[0] = 1;
        $info[1] = $usuarioid;
        $info[2] = is_null($request->input('idtarea')) ? '' : trim($request->input('idtarea'));
        $info[3] = is_null($request->input('txtTitulo')) ? '' : trim($request->input('txtTitulo'));
        $info[4] = is_null($request->input('txtDescripcion')) ? '' : trim($request->input('txtDescripcion'));
        $info[5] = is_null($request->input('dtbFechaVencimiento')) ? '' : trim($request->input('dtbFechaVencimiento'));
        $info[6] = $usuarioid;
        $info[7] = $ip_maq;

        $data   = $model->mantenimientoData($info);
        return response()->json($data, 200);
    }


    public function deleteTarea(Request $request)
    {
        //Datos Generales
        $model   = new Tarea();
        $usuarioid = 1;//auth()->user()->id;
        $ip_maq = $request->ip();
        $info[0] = 2;
        $info[1] = is_null($request->input('idtarea')) ? '0' : trim($request->input('idtarea'));
        $info[2] = $usuarioid;
        $info[3] = $ip_maq;
        $data   = $model->mantenimientoData($info);
        return response()->json($data, 200);
    }
}
