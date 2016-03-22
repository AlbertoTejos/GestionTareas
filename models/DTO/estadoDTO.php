<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class estadoDTO{
    public $idEstado;
    public $nombre;
    public $nivelAvance;
    
    function getIdEstado() {
        return $this->idEstado;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getNivelAvance() {
        return $this->nivelAvance;
    }

    function setIdEstado($idEstado) {
        $this->idEstado = $idEstado;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setNivelAvance($nivelAvance) {
        $this->nivelAvance = $nivelAvance;
    }


}

