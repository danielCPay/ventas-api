<?php

namespace App\Http\Controllers\Mantenedores;


use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\ClienteLogic;
use Illuminate\Http\Request;
use App\Clases\General;

class ClienteController extends Controller
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

            $res = ClienteLogic::Listado(
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
            $datos = (array)$request->get("cliente");
            //$datos['idUsuario']=1;
            $res = ClienteLogic::Insertar_Actualizar($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }
    
    public function ClienteGetNroDocumento(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->input();
            $nrdocumento = intval($datos['nrdocumento']);       
            $res = ClienteLogic::ClienteGetNroDocumento($nrdocumento);
        } catch (\Exception $e) {
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function Cliente_Desplegable(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            //$datos = (array)$request->input();
            $tipodocumento = $request->input("tipodocumento", NULL);
            //$tipodocumento = $datos['tipodocumento'];  
            $res =ClienteLogic::Cliente_Desplegable($tipodocumento);
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
            $datos = (array)$request->get("cliente");           
            $res = ClienteLogic::Anular($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}