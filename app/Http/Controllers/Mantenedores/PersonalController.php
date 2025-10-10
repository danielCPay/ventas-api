<?php

namespace App\Http\Controllers\Mantenedores;


use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\PersonalLogic;
use Illuminate\Http\Request;
use App\Clases\General;

class PersonalController extends Controller
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
          
            $nombres = $request->input("nombres", NULL);

            $res = PersonalLogic::Listado(
                $page_index, $page_size, $nombres
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
            $datos = (array)$request->get("personal");
            //$datos['idUsuario']=1;
            $res = PersonalLogic::Insertar_Actualizar($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }  
    public function Personal_Desplegable(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $res = PersonalLogic::Personal_Desplegable();
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
            $datos = (array)$request->get("personal");           
            $res = PersonalLogic::Anular($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}