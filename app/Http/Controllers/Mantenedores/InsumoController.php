<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\InsumoLogic;
use Illuminate\Http\Request;
use App\Clases\General;

class InsumoController extends Controller
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

            $idSubCategoria = $request->input("idSubCategoria", NULL);
            $descripcionInsumo = $request->input("descripcionInsumo", NULL);

            $res = InsumoLogic::Listado(
                $page_index, $page_size, $idSubCategoria, $descripcionInsumo
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
            $datos = (array)$request->get("insumo");
            //$datos['idUsuario']=1;
            $res = InsumoLogic::Insertar_Actualizar($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }      

    public function Obtener_Insumo(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->input();
            $insumoid = intval($datos['insumoid']);       
            $res = InsumoLogic::Obtener_Insumo($insumoid);
        } catch (\Exception $e) {
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}