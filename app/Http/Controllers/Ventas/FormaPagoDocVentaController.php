<?php

namespace App\Http\Controllers\Ventas;
use App\Clases\General;
use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Ventas\FormaPagoDocVentaLogic;
use Illuminate\Http\Request;

class FormaPagoDocVentaController extends Controller
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

            $nroExpediente = $request->input("nroExpediente", NULL);
            $idTramite = $request->input("idTramite", NULL);
            $nroDocumento = $request->input("nroDocumento", NULL);
            $idTipoDocumento = $request->input("idTipoDocumento", NULL);
            $nombreApellido = $request->input("nombreApellido", NULL);


            $res = VentasLogic::Listado(
                $page_index, $page_size, 
                $nroExpediente, $idTramite, $nroDocumento, $idTipoDocumento, $nombreApellido
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
            $datos = (array)$request->get("formapago");           
            $res = FormaPagoDocVentaLogic::Insertar_Actualizar($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}