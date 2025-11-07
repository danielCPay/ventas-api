<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//producto
$router->get('/producto/listado', 'Mantenedores\ProductoController@Listado');
$router->get('/producto/presentacion/listado', 'Mantenedores\ProductoController@ListadoProductosPresentacion');
$router->post('/producto/agregar', 'Mantenedores\ProductoController@Insertar_Actualizar');
$router->put('/producto/modificar', 'Mantenedores\ProductoController@Insertar_Actualizar');
$router->get('/producto/topproductos', 'Mantenedores\ProductoController@TopProductos');
$router->get('/producto/obtener', 'Mantenedores\ProductoController@Obtener_Producto');
$router->get('/producto/obtener/codigobarra', 'Mantenedores\ProductoController@Obtener_Producto_CodigoBarra');
$router->put('/producto/anular', 'Mantenedores\ProductoController@Anular');
$router->get('/presentacion/precios/codigo', 'Mantenedores\ProductoController@Obtener_Presentacion_Codigo');
$router->get('/imprimir-codigos', 'BarcodeController@imprimirCodigos');

//subFamilia
$router->get('/subfamilia/desplegable', 'Mantenedores\SubFamiliaController@SubFamilia_Desplegable');
$router->get('/subfamilia/getid', 'Mantenedores\SubFamiliaController@SubFamiliaGetId');
$router->get('/subfamilia/listado', 'Mantenedores\SubFamiliaController@Listado');
$router->post('/subfamilia/agregar', 'Mantenedores\SubFamiliaController@Insertar_Actualizar');
$router->put('/subfamilia/modificar', 'Mantenedores\SubFamiliaController@Insertar_Actualizar');
$router->put('/subfamilia/anular', 'Mantenedores\SubFamiliaController@Anular');

//subCategoria
$router->get('/subcategoria/desplegable', 'Mantenedores\SubCategoriaController@SubCategoria_Desplegable');

//unidadmedida
$router->get('/unidadmedida/desplegable', 'Mantenedores\UnidadMedidaController@Unidad_Medida_Desplegable');

//emvionubefact
$router->post('/ventas/envionubefact', 'Ventas\NubeFactController@EnviarComprobanteNubeFact');
$router->post('/ventas/anularnubefact', 'Ventas\NubeFactController@AnularComprobanteNubeFact');
$router->post('/ventas/consultarnubefact', 'Ventas\NubeFactController@ConsultarComprobanteNubeFact');

//pedido
$router->post('/pedido/agregar', 'Pedido\PedidoController@Insertar_Actualizar');
$router->put('/pedido/modificar', 'Pedido\PedidoController@Insertar_Actualizar');
$router->get('/pedido/pedidogetmesaid', 'Pedido\PedidoController@PedidoGetMesaid');
$router->get('/pedido/pedidodetalleid', 'Pedido\PedidoController@PedidoDetalleGetId');
$router->put('/pedido/actualizarestadopedido', 'Pedido\PedidoController@ActualizarEstadoPedido');
$router->put('/pedido/actualizarmesapedido', 'Pedido\PedidoController@ActualizarMesaPedido');
$router->put('/pedido/anularpedidodetalle', 'Pedido\PedidoController@AnularPedidoDetalle');
$router->get('/pedido/listado', 'Pedido\PedidoController@Listado');
$router->post('/pedido/transferirpedido', 'Pedido\PedidoController@TransferirPedido');

//ventas
$router->post('/ventas/agregar', 'Ventas\VentasController@Insertar_Actualizar');
$router->get('/ventas/listado', 'Ventas\VentasController@Listado');
$router->put('/ventas/actualizarventanubefact', 'Ventas\VentasController@Actualizar_Docventa_NubeFact');
$router->put('/ventas/anular', 'Ventas\VentasController@AnularVenta');
$router->put('/ventas/actualizar', 'Ventas\VentasController@ActualizarVenta');
$router->get('/ventas/detalleventa', 'Ventas\VentasController@ObtenerDetalleDocVentaId');

//cliente
$router->get('/cliente/listado', 'Mantenedores\ClienteController@Listado');
$router->post('/cliente/agregar', 'Mantenedores\ClienteController@Insertar_Actualizar');
$router->put('/cliente/modificar', 'Mantenedores\ClienteController@Insertar_Actualizar');
$router->get('/cliente/getnrodocumento', 'Mantenedores\ClienteController@ClienteGetNroDocumento');
$router->get('/cliente/desplegable', 'Mantenedores\ClienteController@Cliente_Desplegable');
$router->put('/cliente/anular', 'Mantenedores\ClienteController@Anular');

//moneda
$router->get('/moneda/listar', 'Mantenedores\MonedaController@Moneda_Desplegable');

//formapago
$router->get('/formapago/desplegable', 'Mantenedores\FormaPagoController@Forma_Pago_Desplegable');

//formapagodocventa
$router->post('/formapagodocventa/agregar', 'Ventas\FormaPagoDocVentaController@Insertar_Actualizar');

//formapago
$router->get('/tarjetacreditoformapago/desplegable', 'Mantenedores\TarjetaCreditoFormaPagoController@TarjetaCredito_FormaPago_Desplegable');

//numeracion
$router->get('/numeracion/numeracioncomprobante', 'Mantenedores\NumeracionController@NumeracionComprobante');
$router->post('/numeracion/ultimonumerousado', 'Mantenedores\NumeracionController@Actualizar_Ultimo_Numero_Usado');

//tipocomprobante
$router->get('/tipocomprobante/listar', 'Mantenedores\TipoComprobanteController@TipoComprobante_Desplegable');

//personal
$router->get('/personal/listado', 'Mantenedores\PersonalController@Listado');
$router->post('/personal/agregar', 'Mantenedores\PersonalController@Insertar_Actualizar');
$router->put('/personal/modificar', 'Mantenedores\PersonalController@Insertar_Actualizar');
$router->get('/personal/desplegable', 'Mantenedores\PersonalController@Personal_Desplegable');
$router->put('/personal/anular', 'Mantenedores\PersonalController@Anular');

//proveedor
$router->get('/proveedor/listado', 'Mantenedores\ProveedorController@Listado');
$router->post('/proveedor/agregar', 'Mantenedores\ProveedorController@Insertar_Actualizar');
$router->put('/proveedor/modificar', 'Mantenedores\ProveedorController@Insertar_Actualizar');
$router->put('/proveedor/anular', 'Mantenedores\ProveedorController@Anular');

//cargo
$router->get('/cargo/desplegable', 'Mantenedores\CargoController@Cargo_Desplegable');

//piso
$router->get('/piso/desplegable', 'Mantenedores\PisoController@Piso_Desplegable');
$router->post('/piso/agregar', 'Mantenedores\PisoController@Insertar_Actualizar');
$router->put('/piso/modificar', 'Mantenedores\PisoController@Insertar_Actualizar');

//mesa
$router->get('/mesa/listadopisobyid', 'Mantenedores\MesaController@ListarMesasPisoById');
$router->put('/mesa/actualizarestadomesa', 'Mantenedores\MesaController@ActualizarEstadoMesa');
$router->get('/mesa/listado', 'Mantenedores\MesaController@Listado');
$router->post('/mesa/agregar', 'Mantenedores\MesaController@Insertar_Actualizar');
$router->put('/mesa/modificar', 'Mantenedores\MesaController@Insertar_Actualizar');
$router->delete('/mesa/anular', 'Mantenedores\MesaController@Anular');

//Familia
$router->get('/familia/desplegable', 'Mantenedores\FamiliaController@Familia_Desplegable');

//cajachica
$router->get('/cajachica/resumencajagastos', 'CajaChica\CajaChicaController@Resumen_Caja_Gastos');
$router->get('/cajachica/resumencajaingreso', 'CajaChica\CajaChicaController@Resumen_Caja_Ingreso');
$router->get('/cajachica/resumencajatarjetas', 'CajaChica\CajaChicaController@Resumen_Caja_Tarjetas');
$router->get('/cajachica/resumencajaventas', 'CajaChica\CajaChicaController@Resumen_Caja_Ventas');
$router->get('/cajachica/resumencajaproductos', 'CajaChica\CajaChicaController@Resumen_Caja_Productos');
$router->get('/cajachica/listado', 'CajaChica\CajaChicaController@Listado');
$router->post('/cajachica/agregar', 'CajaChica\CajaChicaController@Insertar_Actualizar');
$router->put('/cajachica/modificar', 'CajaChica\CajaChicaController@Insertar_Actualizar');
$router->put('/cajachica/cierre', 'CajaChica\CajaChicaController@Cierre_Caja');
$router->get('/cajachica/generarnumerocaja', 'CajaChica\CajaChicaController@Genera_Numero_CajaChica');
$router->get('/cajachica/verificarnumerocaja', 'CajaChica\CajaChicaController@Verificar_CajaChica_Usuario');
$router->get('/cajachica/verificarcajanroliquidacion', 'CajaChica\CajaChicaController@Verificar_CajaChica_Num_Liquidacion');

/* cierrecajacahica */
$router->get('/cajachica/cierre/generar_pdf', 'CajaChica\CierreCajaChicaController@GenerarPDF');

/* perfilusuario */
$router->get('/perfilusuario/desplegable', 'Mantenedores\PerfilUsuarioController@Perfil_Desplegable');

/* usuario */
$router->post('/usuario/login', 'Mantenedores\UsuarioController@Login');

//gastos
$router->get('/gastos/listado', 'CajaChica\GastosCajaController@Listado');
$router->post('/gastos/agregar', 'CajaChica\GastosCajaController@Insertar_Actualizar');
$router->put('/gastos/modificar', 'CajaChica\GastosCajaController@Insertar_Actualizar');

//insumos
$router->get('/insumo/listado', 'Mantenedores\InsumoController@Listado');
$router->post('/insumo/agregar', 'Mantenedores\InsumoController@Insertar_Actualizar');
$router->put('/insumo/modificar', 'Mantenedores\InsumoController@Insertar_Actualizar');
$router->get('/insumo/obtener', 'Mantenedores\InsumoController@Obtener_Insumo');

/* preciospresentacion */
$router->get('/preciospresentacion/listadopreciosproductos', 'Mantenedores\PrecioPresentacionController@ListadoPreciosPresentacion');
$router->post('/preciospresentacion/agregar', 'Mantenedores\PrecioPresentacionController@Insertar_Actualizar');
$router->put('/preciospresentacion/modificar', 'Mantenedores\PrecioPresentacionController@Insertar_Actualizar');

/* imprimir */
$router->get('/ventas/printticketventa', 'Ventas\PrintTicketController@PrintTicketVenta');

//compras
$router->get('/compras/listado', 'Compras\ComprasController@Listado');
$router->get('/compras/detalle', 'Compras\ComprasController@ObtenerDetalleDocCompraId');
$router->post('/compras/agregar', 'Compras\ComprasController@Insertar_Actualizar');
$router->put('/compras/modificar', 'Compras\ComprasController@Insertar_Actualizar');
$router->put('/compras/anular', 'Compras\ComprasController@AnularCompra');
$router->put('/compras/anulardetalle', 'Compras\ComprasController@AnularCompraDetalle');
$router->get('/compras/condicionespago', 'Compras\ComprasController@CondicionesPagoDesplegable');
$router->get('/compras/listadoprovisionar', 'Compras\ComprasController@ListarComprasProvisionar');
$router->get('/compras/detalleprovisionar', 'Compras\ComprasController@ObtenerDetalleDocCompraProvionarId');
$router->get('/compras/existenumerofactura', 'Compras\ComprasController@ExisteNumFactCompra');

//notaingreso
$router->get('/notaingreso/listado', 'Almacen\NotaIngresoController@Listado');
$router->post('/notaingreso/agregar', 'Almacen\NotaIngresoController@Insertar_Actualizar');
$router->put('/notaingreso/modificar', 'Almacen\NotaIngresoController@Insertar_Actualizar');
$router->get('/notaingreso/numeracionnotaingreso', 'Almacen\NotaIngresoController@NumeracionNotaIngreso');
$router->put('/notaingreso/anular', 'Almacen\NotaIngresoController@AnularNontaIngreso');
$router->get('/notaingreso/detellenotaingreso', 'Almacen\NotaIngresoController@ObtenerDetalleNotaIngresoId');
$router->put('/notaingreso/anulardetalle', 'Almacen\NotaIngresoController@AnularNotaIngresoDetalle');

//movimientos
$router->post('/movimientosalmacen/agregar', 'Almacen\MovimientosController@Insertar_Actualizar');
$router->put('/movimientosalmacen/modificar', 'Almacen\MovimientosController@Insertar_Actualizar');
$router->get('/movimientosalmacen/listadostock', 'Almacen\MovimientosController@ListadoStock');
$router->get('/movimientosalmacen/productos', 'Almacen\MovimientosController@MovimientosAlmacenProductos');

//notasalida
$router->get('/notasalida/listado', 'Almacen\NotaSalidaController@Listado');
$router->post('/notasalida/agregar', 'Almacen\NotaSalidaController@Insertar_Actualizar');
$router->put('/notasalida/modificar', 'Almacen\NotaSalidaController@Insertar_Actualizar');
$router->get('/notasalida/numeracionnotasalida', 'Almacen\NotaSalidaController@NumeracionNotaSalida');
$router->put('/notasalida/anular', 'Almacen\NotaSalidaController@AnularNotaSalida');
$router->get('/notasalida/detellenotasalida', 'Almacen\NotaSalidaController@ObtenerDetalleNotaSalidaId');
$router->put('/notasalida/anulardetalle', 'Almacen\NotaSalidaController@AnularNotaSalidaDetalle');

//almacen
$router->get('/almacen/desplegable', 'Mantenedores\AlmacenController@Almacen_Desplegable');

//conceptomovimiento
$router->get('/conceptomovimiento/desplegable', 'Mantenedores\ConceptoMovimientoController@Concepto_Movimiento_Desplegable');
