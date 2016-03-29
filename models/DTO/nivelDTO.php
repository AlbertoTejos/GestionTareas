<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nivelDTO
 *
 * @author Beto
 */
class nivelDTO {
    
    private $idNivel;
    private $nombreNivel;
    private $idProyecto;
    private $nombreProyecto;
    private $tiempoMaximo;
    
    function getTiempoMaximo() {
        return $this->tiempoMaximo;
    }

    function setTiempoMaximo($tiempoMaximo) {
        $this->tiempoMaximo = $tiempoMaximo;
    }

        
    function getIdNivel() {
        return $this->idNivel;
    }

    function getNombreNivel() {
        return $this->nombreNivel;
    }

    function getIdProyecto() {
        return $this->idProyecto;
    }

    function getNombreProyecto() {
        return $this->nombreProyecto;
    }

    function setIdNivel($idNivel) {
        $this->idNivel = $idNivel;
    }

    function setNombreNivel($nombreNivel) {
        $this->nombreNivel = $nombreNivel;
    }

    function setIdProyecto($idProyecto) {
        $this->idProyecto = $idProyecto;
    }

    function setNombreProyecto($nombreProyecto) {
        $this->nombreProyecto = $nombreProyecto;
    }


}
