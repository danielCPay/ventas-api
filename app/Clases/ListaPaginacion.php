<?php

namespace App\Clases;

class ListaPaginacion
{
    public  $datos = [];   
    public  $totalRegistros;
    public  $registrosPorPagina;
    public  $paginaActual;
    public  $totalPaginas;

    public function __construct($datos, $totalRegistros, $registrosPorPagina, $paginaActual)
    {
        $this->datos = $datos;
        $this->totalRegistros = $totalRegistros;
        $this->registrosPorPagina = $registrosPorPagina;
        $this->paginaActual = $paginaActual + 1;
        $this->totalPaginas = ceil($totalRegistros / $registrosPorPagina);
    }
}
