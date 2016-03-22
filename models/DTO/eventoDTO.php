<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of eventoDTO
 *
 * @author Beto
 */
class eventoDTO {
    
    private $idEvento;
    private $nombreEvento;
    private $idTrabajo;
    private $nombreTrabajo;
    private $nombreProyecto;
    
    function getNombreProyecto() {
        return $this->nombreProyecto;
    }

    function setNombreProyecto($nombreProyecto) {
        $this->nombreProyecto = $nombreProyecto;
    }

        
    function getNombreTrabajo() {
        return $this->nombreTrabajo;
    }

    function setNombreTrabajo($nombreTrabajo) {
        $this->nombreTrabajo = $nombreTrabajo;
    }

        
    function getIdEvento() {
        return $this->idEvento;
    }

    function getNombreEvento() {
        return $this->nombreEvento;
    }

    function getIdTrabajo() {
        return $this->idTrabajo;
    }

    function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }

    function setNombreEvento($nombreEvento) {
        $this->nombreEvento = $nombreEvento;
    }

    function setIdTrabajo($idTrabajo) {
        $this->idTrabajo = $idTrabajo;
    }


}
