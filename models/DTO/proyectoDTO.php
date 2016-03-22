<?php
class proyectoDTO{
    
    public $id_producto;
    public $nombre;
    public $nemo;
    public $id_cliente;
    private $nombreCliente;
    
    function getCliente(){ 
        return $this->nombreCliente;
    }
    
    function setCliente($cliente) {
        $this->nombreCliente = $cliente;
    }
    
    function getId_producto() {
        return $this->id_producto;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getNemo() {
        return $this->nemo;
    }

    function getId_cliente() {
        return $this->id_cliente;
    }

    function setId_producto($id_producto) {
        $this->id_producto = $id_producto;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setNemo($nemo) {
        $this->nemo = $nemo;
    }

    function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }

 
    
    
}