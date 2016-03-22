<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of organizacionDTO
 *
 * @author Jaime
 */
class organizacionDTO {
    public $id_organizacion;
    public $descripcion;
    public $fechacreacion;
    public $usuario;
    
    function getId_organizacion() {
        return $this->id_organizacion;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFechacreacion() {
        return $this->fechacreacion;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setId_organizacion($id_organizacion) {
        $this->id_organizacion = $id_organizacion;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setFechacreacion($fechacreacion) {
        $this->fechacreacion = $fechacreacion;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }


    
}
