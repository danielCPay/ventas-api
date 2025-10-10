<?php

namespace App\Http\Controllers\CajaChica;
use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\CajaChica\GastosCajaLogic;
use Illuminate\Http\Request;
use App\Clases\General;

class GastosCajaController extends Controller
{
    public function __construct()
    {
    }

    public function Listado(Request $request)
    {     
        $res = new RespuestaOperacion();
        try {
            $page_index = intval($request->input("page_index", 1)) - 1;
            $page_size = intval($request->input("page_size", 10));
          
            $fecha_inicio = $request->input("fecha_inicio", NULL);
            $fecha_fin = $request->input("fecha_fin", NULL);

            $res = GastosCajaLogic::Listado(
                $page_index, $page_size, $fecha_inicio, $fecha_fin
            );
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }
    public function Insertar_Actualizar(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("gastos");
            //$datos['idUsuario']=1;
            $res = GastosCajaLogic::Insertar_Actualizar($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }  

}