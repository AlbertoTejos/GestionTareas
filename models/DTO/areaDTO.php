<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of areaDTO
 *
 * @author Alberto Tejos
 */
class areaDTO {
    
    private $idArea;
    private $nombre;
    private $idEvento;
    private $nombreEvento;
    
    function getNombreEvento() {
        return $this->nombreEvento;
    }

    function setNombreEvento($nombreEvento) {
        $this->nombreEvento = $nombreEvento;
    }

        
    function getIdArea() {
        return $this->idArea;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getIdEvento() {
        return $this->idEvento;
    }

    function setIdArea($idArea) {
        $this->idArea = $idArea;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }


}
