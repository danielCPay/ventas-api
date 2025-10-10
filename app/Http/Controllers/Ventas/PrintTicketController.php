<?php

namespace App\Http\Controllers\Ventas;
use App\Clases\General;
use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use Illuminate\Http\Request;
use App\Logic\Ventas\PrintTicketLogic;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class PrintTicketController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function PrintTicketVenta(Request $request)
    {
        $res = new RespuestaOperacion();
        try {         
            $datos = (array)$request->input();
            $docventaid = intval($datos['docventaid']);         
            $res = PrintTicketLogic::PrintTicketVenta($datos);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }      

        return RespuestaOperacion::enviarJsonObj($res);   
    }   

    
}
