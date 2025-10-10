<?php

namespace App\Http\Controllers\Mantenedores;


use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\PrecioPresentacionLogic;
use Illuminate\Http\Request;
use App\Clases\General;

class PrecioPresentacionController extends Controller
{
    public function __construct()
    {
    }
   
    public function Insertar_Actualizar(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("preciospresentacion");           
            $res = PrecioPresentacionLogic::Insertar_Actualizar($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }        

    public function ListadoPreciosPresentacion(Request $request)
    {
        $res = new RespuestaOperacion();
        try {

            $productoid = intval($request->get("productoid"));
          
            $res = PrecioPresentacionLogic::ListadoPreciosPresentacion($productoid);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }
    

}