<?php

namespace App\Http\Controllers\Mantenedores;


use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\ProductoLogic;
use Illuminate\Http\Request;
use App\Clases\General;

class ProductoController extends Controller
{
    public function __construct() {}

    public function Listado(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $page_index = intval($request->input("page_index", 1)) - 1;
            $page_size = intval($request->input("page_size", 10));

            $idSubFamilia = $request->input("idSubFamilia", NULL);
            $descripcionProducto = $request->input("descripcionProducto", NULL);

            $res = ProductoLogic::Listado(
                $page_index,
                $page_size,
                $idSubFamilia,
                $descripcionProducto
            );
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }
    public function ListadoProductosPresentacion(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $page_index = intval($request->input("page_index", 1)) - 1;
            $page_size = intval($request->input("page_size", 10));

            $idSubFamilia = $request->input("idSubFamilia", NULL);
            $descripcionProducto = $request->input("descripcionProducto", NULL);

            $res = ProductoLogic::ListadoProductosPresentacion(
                $page_index,
                $page_size,
                $idSubFamilia,
                $descripcionProducto
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
            $datos = (array)$request->get("producto");
            //$datos['idUsuario']=1;
            $res = ProductoLogic::Insertar_Actualizar($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }
    public function TopProductos(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->input();
            $mes = intval($datos['mes']);
            $anio = intval($datos['anio']);

            $res = ProductoLogic::TopProductos($mes, $anio);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function Obtener_Producto(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->input();
            $productoid = intval($datos['productoid']);
            $res = ProductoLogic::Obtener_Producto($productoid);
        } catch (\Exception $e) {
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function Anular(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("producto");
            $res = ProductoLogic::Anular($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }
}
