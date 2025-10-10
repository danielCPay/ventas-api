<?php

namespace App\Http\Controllers\Mantenedores;


use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\ProveedorLogic;
use Illuminate\Http\Request;
use App\Clases\General;

class ProveedorController extends Controller
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
          
            $razonsocial = $request->input("razonsocial", NULL);

            $res = ProveedorLogic::Listado(
                $page_index, $page_size, $razonsocial
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
            $datos = (array)$request->get("proveedor");
            //$datos['idUsuario']=1;
            $res = ProveedorLogic::Insertar_Actualizar($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }  
    public function Anular(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("proveedor");           
            $res = ProveedorLogic::Anular($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}