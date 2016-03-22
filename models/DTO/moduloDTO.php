<?php
class moduloDTO{
    public $idHito;
    public $nombre;
    public $idProducto;
    public $nombreProducto;
    private $estado;
    
    function getEstado() {
        return $this->estado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

        
    function getNombreProducto() {
        return $this->nombreProducto;
    }

    function setNombreProducto($nombreProducto) {
        $this->nombreProducto = $nombreProducto;
    }

        function getIdHito() {
        return $this->idHito;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getIdProducto() {
        return $this->idProducto;
    }

    function setIdHito($idHito) {
        $this->idHito = $idHito;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }


    
    
}

