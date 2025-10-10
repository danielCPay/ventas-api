<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\MesaLogic;
use Illuminate\Http\Request;
use App\Clases\General;

class MesaController extends Controller
{
    public function __construct()
    {
    }

    public function ListarMesasPisoById(Request $request)
    {
        $res = new RespuestaOperacion();
        try {

            $pisoid = intval($request->get("pisoid"));

            if(General::isEmpty($pisoid) || $pisoid<=0){
                $pisoid = NULL;
            }

            $res = MesaLogic::ListarMesasPisoById($pisoid);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function ActualizarEstadoMesa(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("mesa");           
            $res = MesaLogic::ActualizarEstadoMesa($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function Listado(Request $request)
    {     
        $res = new RespuestaOperacion();
        try {
            $page_index = intval($request->input("page_index", 1)) - 1;
            $page_size = intval($request->input("page_size", 10));
          
            $descripcionmesa = $request->input("descripcionmesa", NULL);
            $pisoid = $request->input("pisoid", NULL);

            $res = MesaLogic::Listado(
                $page_index, $page_size, $descripcionmesa, $pisoid
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
            $datos = (array)$request->get("mesa");
            //$datos['idUsuario']=1;
            $res = MesaLogic::Insertar_Actualizar($datos);
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
            $datos = (array)$request->get("mesa");
            $id = intval($datos['id']);
            $user = $datos['user'];
            
            $res = MesaLogic::Anular($id,$user);
        } catch (\Exception $e) {
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}