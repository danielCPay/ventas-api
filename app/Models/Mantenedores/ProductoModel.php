<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class ProductoModel
{
    public static function Listado(Int $page_index, Int $page_size, 
	$idSubFamilia,$descripcionProducto):  ListaPaginacion
	{   
        $parametros = array(
			$page_index,
			$page_size,
			$idSubFamilia,
            $descripcionProducto
		);
		$dbh = DB::getPdo();
		$dbh->setAttribute($dbh::ATTR_EMULATE_PREPARES, true);
		$stmt = $dbh->prepare('CALL sp_pro_listar(?, ?, ?, ?)');
		$stmt->execute($parametros);
		$listarRegistros = $stmt->fetchAll($dbh::FETCH_CLASS);
		$stmt->nextRowset();
		$total_registros = $stmt->fetchAll($dbh::FETCH_CLASS);
		$stmt->closeCursor();
		unset($stmt);
		unset($dbh);
		$totalRegistros = $total_registros[0]->total_registros;
		return new ListaPaginacion($listarRegistros, $totalRegistros, $page_size, $page_index);		      
	}

	public static function ListadoProductosPresentacion(Int $page_index, Int $page_size, 
	$idSubFamilia,$descripcionProducto):  ListaPaginacion
	{   
        $parametros = array(
			$page_index,
			$page_size,
			$idSubFamilia,
            $descripcionProducto
		);
		$dbh = DB::getPdo();
		$dbh->setAttribute($dbh::ATTR_EMULATE_PREPARES, true);
		$stmt = $dbh->prepare('CALL sp_pro_pre_listar(?, ?, ?, ?)');
		$stmt->execute($parametros);
		$listarRegistros = $stmt->fetchAll($dbh::FETCH_CLASS);
		$stmt->nextRowset();
		$total_registros = $stmt->fetchAll($dbh::FETCH_CLASS);
		$stmt->closeCursor();
		unset($stmt);
		unset($dbh);
		$totalRegistros = $total_registros[0]->total_registros;
		return new ListaPaginacion($listarRegistros, $totalRegistros, $page_size, $page_index);		      
	}

	public static function Insertar_Actualizar(Array $datos): Object
	{		
		$parametros = array(
			array_key_exists('productoid',$datos)? $datos['productoid']:NULL,			
			$datos['descripcionproducto'],
			$datos['marca'],
			$datos['precioventa'],
			$datos['costo'],
			$datos['subfamiliaid'],		
			$datos['unidadmedidaid'],	
			$datos['codigo'],
			$datos['stockminimo'],
			$datos['cantidadunidadmedida']						
		);
		//{"producto":{"productoid":0,"codigo":1,"precioventa":40,"subfamiliaid":3,"unidadmedidaid":1,"costo":10,"marca":"OTROS","stockminimo":10}}
		$res = DB::select("CALL sp_pro_ins_upd(?,?,?,?,?,?,?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}

	public static function TopProductos(Int $mes, Int $anio): array
	{
		$parametros=array($mes,$anio);
		$res = DB::select("CALL sp_top_productos(?,?)",$parametros);
		return $res;
		
	}

	public static function Obtener_Producto(Int $productoid): Object
	{
		$parametros = array(
			$productoid			
		);
		$res = DB::select("CALL sp_obtener_producto(?)",$parametros);
		return $res[0] ?? new \stdClass();
	}
	public static function Anular(Array $datos): Object
	{		       
		$parametros = array(				
			$datos['productoid'],
			$datos['user']										
		);
		$res = DB::select("CALL sp_producto_anular(?,?)",$parametros);
		return $res[0] ?? null;
	}
	public static function Obtener_Presentacion_Codigo($codigo): Object
	{
		$parametros = array(
			$codigo			
		);
		$res = DB::select("CALL sp_obtener_presentacion_codigo(?)",$parametros);
	
		return $res[0] ?? new \stdClass();
	}

}