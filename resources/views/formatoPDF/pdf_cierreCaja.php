<!DOCTYPE html>
<html lang="es">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<style>
			html {
				width: 100%;
				height: 100%;
				margin-top: 40px;
				margin-left: 30px;
				margin-right: 30px;
				margin-bottom: 20px;
				/*margin-top: 180px;*/
				font: 80% sans-serif;
			}
		</style>
		<style>
			.tabla_v1 {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 10px;
				border-collapse: collapse;
				width: 100%;
			}

			.tabla_v1 td, .tabla_v1 th {
				border: 1px solid #ddd;
				padding: 5px;
				text-align: center;
			}

			.tabla_v1 tr:nth-child(even){background-color: #f2f2f2;}

			.tabla_v1 th {
				padding-top: 5px;
				padding-bottom: 5px;
				text-align: center;
				background-color: #0088b6;
				color: white;
			}

			.tabla_v2 {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 10px;
				border-collapse: collapse;
				width: 50%;
			}

			.tabla_v2 td, .tabla_v2 th {
				border: 1px solid #ddd;
				padding: 5px;
				text-align: center;
			}

			.tabla_v2 tr:nth-child(even){background-color: #f2f2f2;}

			.tabla_v2 th {
				padding-top: 5px;
				padding-bottom: 5px;
				text-align: center;
				background-color: #0088b6;
				color: white;
			}		

			.tabla_v3 {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 10px;
				border-collapse: collapse;
				width: 40%;
			}

			.tabla_v3 td, .tabla_v3 th {
				border: 1px solid #ddd;
				padding: 5px;
				text-align: center;
			}

			.tabla_v3 tr:nth-child(even){background-color: #f2f2f2;}

			.tabla_v3 th {
				padding-top: 5px;
				padding-bottom: 5px;
				text-align: center;
				background-color: #0088b6;
				color: white;
			}		

			.columnas {
            column-count:2;
			column-gap: 3em;
			column-rule: 1px solid #bbb;
			column-width: 140px;
        }

		</style>
		
	</head>

<body>
<div class="row">
			<div class="col-6">
				<b>Liquidación por Cajero</b>
			</div>
			<div class="col-6">
			<b>Usuario: </b><?php echo $cierrecaja['codusu'];?> <b>Día: </b> <?php echo $cierrecaja['fechaapertura'];?>
			<b>N° Liquidación: </b> <?php echo $cierrecaja['nroliquidacion'];?>
			</div>
</div>
<div>		
	<p>
		<h4 style="margin: 0px;">Ventas del Día</h4>
		<hr>
	</p>
	<table class="tabla_v1">
		<tr>
			<th>Numdoc</th>	
			<th>Fecha</th>	
			<th>Tipo Comprobante</th>	
			<!-- <th>Mesa</th> -->
			<th>Forma Pago</th>
			<th>Moneda</th>				
			<!-- <th>Pedidoid</th>						 -->
			<th>Estado</th>
			<th>SOLES</th>
			<th>DOLARES</th>
		</tr>
		<?php $total_ventas_soles = 0;
			  $total_ventas_dolares = 0;
			  $total_efectivo_soles = 0;
			  $total_efectivo_dolares = 0;
			  $total_tarjeta_soles = 0;
			  $total_tarjeta_dolares = 0;
		 ?>  
		<?php
			for ($i=0; $i < Count($cierrecaja['cajaventas']) ; $i++) { 

				$total_ventas_soles = $total_ventas_soles + $cierrecaja['cajaventas'][$i]->SOLES;
				$total_ventas_dolares = $total_ventas_dolares + $cierrecaja['cajaventas'][$i]->DOLARES;
				$soles  = number_format($cierrecaja['cajaventas'][$i]->SOLES, 2, ',', '.');
				$dolares  = number_format($cierrecaja['cajaventas'][$i]->DOLARES, 2, ',', '.');

				if ($cierrecaja['cajaventas'][$i]->descripcionformapago == "EFECTIVO") {
					$total_efectivo_soles = $total_efectivo_soles + $cierrecaja['cajaventas'][$i]->SOLES;
					$total_efectivo_dolares = $total_efectivo_dolares + $cierrecaja['cajaventas'][$i]->DOLARES;
				} else if ($cierrecaja['cajaventas'][$i]->descripcionformapago == "TARJETA DE CREDITO") {
					$total_tarjeta_soles = $total_tarjeta_soles + $cierrecaja['cajaventas'][$i]->SOLES;
					$total_tarjeta_dolares = $total_tarjeta_dolares + $cierrecaja['cajaventas'][$i]->DOLARES;
				}
				
				echo "<tr>";
				echo "<td>{$cierrecaja['cajaventas'][$i]->numdoc}</td>";	
				echo "<td>{$cierrecaja['cajaventas'][$i]->fecha}</td>";	
				echo "<td>{$cierrecaja['cajaventas'][$i]->descripciontipocomprobante}</td>";
				// echo "<td>{$cierrecaja['cajaventas'][$i]->descripcionmesa}</td>";	
				echo "<td>{$cierrecaja['cajaventas'][$i]->descripcionformapago}</td>";
				echo "<td>{$cierrecaja['cajaventas'][$i]->moneda}</td>";							
				// echo "<td>{$cierrecaja['cajaventas'][$i]->pedidoid}</td>";							
				echo "<td>{$cierrecaja['cajaventas'][$i]->estado}</td>";				
				echo "<td>{$soles}</td>";
				echo "<td>{$dolares}</td>";
				echo "</tr>";
			}
		?>
		 <tr>
            <td colspan="6" style="text-align: right"><strong>TOTAL</strong></td>
            <td><strong><?php echo number_format($total_ventas_soles, 2, ',', '.'); ?></strong></td>
			<td><strong><?php echo number_format($total_ventas_dolares, 2, ',', '.'); ?></strong></td>
          </tr> 
	</table>		
	<p>
		<h4 style="margin: 0px;">Resumen de Caja</h4>
		<!-- <hr> -->
	</p>
	<table class="tabla_v3">
		<tr>
			<th>Descripción</th>
			<th>Monto</th>		
		</tr>
		<?php $saldoinicial = 0;
			  $monto=0; ?>  
		<?php
			for ($i=0; $i < Count($cierrecaja['cajaingreso']) ; $i++) { 
				$saldoinicial = $cierrecaja['cajaingreso'][$i]->monto;
				$monto  = number_format($cierrecaja['cajaingreso'][$i]->monto, 2, ',', '.');
				echo "<tr>";
				echo "<td>{$cierrecaja['cajaingreso'][$i]->observacion}</td>";
				echo "<td>{$monto}</td>";		
				echo "</tr>";
			}
		?>
		<tr>
			<td>Efectivo Soles</td>
			<td><?php echo number_format($total_efectivo_soles, 2, ',', '.'); ?></td>			
		</tr>
		<tr>
			<td>Efectivo Dolares</td>
			<td><?php echo number_format($total_efectivo_dolares, 2, ',', '.'); ?></td>	
		</tr>
		<tr>
			<td>Tarjeta Credito Soles</td>
			<td><?php echo number_format($total_tarjeta_soles, 2, ',', '.'); ?></td>	
		</tr>
		<tr>
			<td>Tarjeta Credito Dolares</td>
			<td><?php echo number_format($total_tarjeta_dolares, 2, ',', '.'); ?></td>	
		</tr>		
	</table>
	
	<p>
		<h4 style="margin: 0px;">Resumen de Gastos</h4>		
	</p>
	<table class="tabla_v2">
		<tr>
			<th>Descripción</th>
			<th>Concepto</th>
			<th>SOLES</th>
			<th>DOLARES</th>
		</tr>
		<?php $total_gastos_soles = 0;
		     $total_gastos_dolares = 0; 
			 $gastos_soles = 0; 
			 $gastos_dolares = 0; 
		 ?>  
		<?php
			for ($i=0; $i < Count($cierrecaja['cajagastos']) ; $i++) { 
				$total_gastos_soles = $total_gastos_soles + $cierrecaja['cajagastos'][$i]->SOLES;	
				$total_gastos_dolares = $total_gastos_dolares + $cierrecaja['cajagastos'][$i]->DOLARES;	
				$gastos_soles  = number_format($cierrecaja['cajagastos'][$i]->SOLES, 2, ',', '.');
				$gastos_dolares  = number_format($cierrecaja['cajagastos'][$i]->DOLARES, 2, ',', '.');

				echo "<tr>";
				echo "<td>{$cierrecaja['cajagastos'][$i]->descripcion}</td>";
				echo "<td>{$cierrecaja['cajagastos'][$i]->concepto}</td>";
				echo "<td>{$gastos_soles}</td>";
				echo "<td>{$gastos_dolares}</td>";
				echo "</tr>";
			}
		?>
		 <tr>
            <td colspan="2" style="text-align: right"><strong>TOTAL</strong></td>
            <td><strong><?php echo number_format($total_gastos_soles, 2, ',', '.'); ?></strong></td>
			<td><strong><?php echo number_format($total_gastos_dolares, 2, ',', '.'); ?></strong></td>
          </tr> 
	</table>

	<p>
		<h4 style="margin: 0px;">Resumen de Tarjetas</h4>		
	</p>
	<table class="tabla_v2">
		<tr>
			<th>Tarjeta</th>
			<th>SOLES</th>
			<th>DOLARES</th>			
		</tr>
		<?php $total_tarjetas_soles = 0;
		      $total_tarjetas_dolares = 0; 
			  $tarjetas_soles = 0;
		      $tarjetas_dolares = 0; 
		 ?>  
		<?php
			for ($i=0; $i < Count($cierrecaja['cajatarjetas']) ; $i++) { 
				$total_tarjetas_soles = $total_tarjetas_soles + $cierrecaja['cajatarjetas'][$i]->SOLES;	
				$total_tarjetas_dolares = $total_tarjetas_dolares + $cierrecaja['cajatarjetas'][$i]->DOLARES;	
				$tarjetas_soles  = number_format($cierrecaja['cajatarjetas'][$i]->SOLES, 2, ',', '.');
				$tarjetas_dolares  = number_format($cierrecaja['cajatarjetas'][$i]->DOLARES, 2, ',', '.');
				echo "<tr>";
				echo "<td>{$cierrecaja['cajatarjetas'][$i]->tarjeta}</td>";
				echo "<td>{$tarjetas_soles}</td>";
				echo "<td>{$tarjetas_dolares}</td>";			
				echo "</tr>";
			}
		?>
		<tr>
            <td colspan="1" style="text-align: right"><strong>TOTAL</strong></td>
            <td><strong><?php echo number_format($total_tarjetas_soles, 2, ',', '.'); ?></strong></td>
			<td><strong><?php echo number_format($total_tarjetas_dolares, 2, ',', '.'); ?></strong></td>
        </tr> 
	</table>	
	<p>
		<h4 style="margin: 0px;">Resumen de Productos</h4>		
	</p>
	<table class="tabla_v1">
		<tr>
			<th>Presentación</th>
			<th>Descripción</th>
			<th>Cantidad</th>
			<th>Total</th>
		</tr>
		<?php $total_cantidad = 0;
		      $total_importe = 0; 
			  $productos_cantidad = 0;
		      $productos_total = 0; 
		 ?>  
		<?php
			for ($i=0; $i < Count($cierrecaja['cajaproductos']) ; $i++) { 
				$total_cantidad = $total_cantidad + $cierrecaja['cajaproductos'][$i]->cantidad;	
				$total_importe = $total_importe + $cierrecaja['cajaproductos'][$i]->total;	
				$productos_cantidad  = number_format($cierrecaja['cajaproductos'][$i]->cantidad, 2, ',', '.');
				$productos_total  = number_format($cierrecaja['cajaproductos'][$i]->total, 2, ',', '.');

				echo "<tr>";
				echo "<td>{$cierrecaja['cajaproductos'][$i]->presentacion}</td>";
				echo "<td>{$cierrecaja['cajaproductos'][$i]->descripcionproducto}</td>";
				echo "<td>{$productos_cantidad}</td>";
				echo "<td>{$productos_total}</td>";	
				echo "</tr>";
			}
		?>
		<tr>
            <td colspan="2" style="text-align: right"><strong>TOTAL</strong></td>
            <td><strong><?php echo number_format($total_cantidad, 2, ',', '.'); ?></strong></td>
			<td><strong><?php echo number_format($total_importe, 2, ',', '.'); ?></strong></td>
        </tr>
	</table>
	
</div>
<p style="font-size: 13px;text-align: left;">
	<b>
		TOTAL CAJA S/.
	<?php
         $total_caja = $saldoinicial + $total_efectivo_soles - $total_gastos_soles;
    ?>
    <?php echo number_format($total_caja, 2, ',', '.'); ?>
	</b>
</p>

</body></html>