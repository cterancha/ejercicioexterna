<?php

namespace App\Http\Controllers;

//Requerido
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Model
use App\Models\Tarea;

class TareaController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }


    public function ver(Request $request)
    {
        $model   = new Tarea();
        $info[0] = 1;
        $info[1] = 1;
        $info[2] = 50;
        $info[3] = auth()->user()->id;  
        $data   = $model->consultarData($info);unset($info);
        $result["lista"] = $data;
        return view('tareas.tarea')->with($result);
    }

    public function consultar(Request $request)
    {
        //Datos Generales
        $_acc = $request->input('_acc');
        $model   = new Tarea();
        $usuarioid = auth()->user()->id;
        $ip_maq = $request->ip();

        switch ($_acc) {
            case 'listar':
                $info[0] = 1;
                $info[1] = is_null($request->input('page')) ? '1' : trim($request->input('page'));
                $info[2] = is_null($request->input('rows')) ? '50' : trim($request->input('rows'));    
                $info[3] = $usuarioid;                
                $data   = $model->consultarData($info);unset($info);
                $result["total"] = $data['registro']["total"];
                $result["rows"] = $data['registro']["items"];
                return response()->json($result);
                break;

            case 'getTarea':
                $info[0] = 3;
                $info[1] = trim($request->input('idtarea'));
                $data   = $model->consultarData($info);unset($info);
                return response()->json($data);
                break;

            case 'getEstado':
                $info[0] = 2;
                $data   = $model->consultarData($info);unset($info);
                return response()->json($data);
                break;

            default:
				return "Error de Acceso";
				break;
            break;
        }
    }
    public function mantenimiento(Request $request)
    {
        //Datos Generales
        $_acc = $request->input('_acc');
        $model   = new Tarea();
        $usuarioid = auth()->user()->id;
        $ip_maq = $request->ip();

        switch ($_acc) {
            case 'guardar_editar':

                $info[0] = 1;
                $info[1] = auth()->user()->id;
                $info[2] = is_null($request->input('idtarea')) ? '' : trim($request->input('idtarea'));
                $info[3] = is_null($request->input('txtTitulo')) ? '' : trim($request->input('txtTitulo'));
                $info[4] = is_null($request->input('txtDescripcion')) ? '' : trim($request->input('txtDescripcion'));
                $info[5] = is_null($request->input('dtbFechaVencimiento')) ? '' : trim($request->input('dtbFechaVencimiento'));
                $info[6] = $usuarioid;
                $info[7] = $ip_maq;

                $data   = $model->mantenimientoData($info);
                return response()->json($data);
            break;

            case 'eliminar':

                $info[0] = 2;
                $info[1] = is_null($request->input('idtarea')) ? '0' : trim($request->input('idtarea'));
                $info[2] = $usuarioid;
                $info[3] = $ip_maq;
                $data   = $model->mantenimientoData($info);
                return response()->json($data);
            break;

            default:
                return "Error de Acceso";
            break;
        }
    }
}
