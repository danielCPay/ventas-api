<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class PrecioPresentacionModel
{   

	public static function Insertar_Actualizar(Array $datos): Object
	{
		$parametros = array(
			array_key_exists('presentacionesid',$datos)? $datos['presentacionesid']:NULL,			
			$datos['productoid'],
			$datos['decripcionpresentacion'],			
			$datos['unidadmedidaid'],	
            $datos['cantidadpresentacion'],					
			$datos['precio']			
		);
		
		$res = DB::select("CALL sp_precios_presentacion_ins_upd(?,?,?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}	

	public static function ListadoPreciosPresentacion(Int $productoid): array
	{
		$res = DB::select("CALL sp_precios_por_producto_list(?)",[$productoid]);
		return $res;
		
	}

}