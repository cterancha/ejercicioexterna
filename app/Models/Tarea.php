<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\QueryException;
use Illuminate\Database\Query\JoinClause;

use DB;
use Schema;
use Hash;
use StdClass;

class Tarea
{
    public function consultarData($xCriterio){
        $data = array();

        /*** 
         * Titulo: Listar tareas 
         * Parámetros: 1:page, 2: size, 3:iduser
        */
        if ($xCriterio[0] == 1){

            $currentPage = $xCriterio[1];
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });

            $dataQuery = DB::table('tarea as tab1')
            ->select(
                'tab1.idtarea',
                'tab2.dni',
                'tab2.name',
                'tab3.descripcion as descripcion_estado',
                'tab1.titulo',
                'tab1.descripcion',
                'tab1.fechavencimiento'
            )
            ->join('users as tab2','tab2.id','tab1.iduser')
            ->join('estado as tab3','tab3.idestado','tab1.idestado')
            ->where('tab1.iduser', '=', $xCriterio[3]);

            $dataPaginator = $dataQuery->paginate($xCriterio[2]);
            $items = $dataPaginator->items();

            $data["total"] = $dataPaginator->total();
            $data["items"] = $items;
        }

        /*** 
         * Titulo: Listar tarea
         * Parámetros: 1: idtarea
        */
        if ($xCriterio[0] == 3){
            $data = DB::table('tarea')
                ->select('*')
                ->where('idtarea', '=', $xCriterio[1])
                ->get();
        }

        return $data == null ? array() : $data;
    }

    public function mantenimientoData($xCriterio){
        $data = array();

        $xNres = 1;
        $xMsj = '';

        /*** 
         * Titulo: 
         * Parámetros:  1:iduser, 2:idtarea, 3:titulo, 4:descripcion, 5:fechavencimiento, 6:usuarioid, 7:ipmaqreg
        */
        if ($xCriterio[0] == 1){

            if ($xCriterio[2] == "" || $xCriterio[2] == "0"){
                $xMsj = 'Se registró correctamente';
                $idmotivo = 
                    DB::table('tarea')->insertGetId(
                    [
                        "iduser" => $xCriterio[1],
                        "idestado" => 'P',
                        "titulo" => $xCriterio[3],
                        "descripcion" => $xCriterio[4],
                        "fechavencimiento" => $xCriterio[5],
                    ]
                );
            }else{
                $xMsj = 'Se actualizó correctamente';
                DB::table('tarea')
                        ->where('idtarea','=',$xCriterio[2])
                        ->update([
                            'idestado' => 'P',
                            'iduser' => $xCriterio[1],
                            "titulo" => $xCriterio[3],
                            "descripcion" => $xCriterio[4],
                            "fechavencimiento" => $xCriterio[5],
                        ]);
            }

            $rpta = new StdClass();
            $rpta->o_nres = $xNres;
            $rpta->o_msj = $xMsj;
            $data[] = $rpta;
        }


        /*** 
         * Titulo: Cambiar estado
         * Parámetros:  1:idtarea
        */
        if ($xCriterio[0] == 2){
            $xMsj = 'Se actualizó el estado correctamente';
                DB::table('tarea')->where('idtarea',$xCriterio[1])->delete();

            $rpta = new StdClass();
            $rpta->o_nres = $xNres;
            $rpta->o_msj = $xMsj;
            $data[] = $rpta;
        }


        return $data == null ? array() : $data;
    }
}