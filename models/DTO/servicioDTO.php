<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of servicioDTO
 *
 * @author Beto
 */
class servicioDTO {
    
    private $idServicio;
    private $nombreServicio;
    private $descripcionServicio;
    private $idArea;
    private $nombreArea;
    
    function getIdServicio() {
        return $this->idServicio;
    }

    function getNombreServicio() {
        return $this->nombreServicio;
    }

    function getDescripcionServicio() {
        return $this->descripcionServicio;
    }

    function getIdArea() {
        return $this->idArea;
    }

    function getNombreArea() {
        return $this->nombreArea;
    }

    function setIdServicio($idServicio) {
        $this->idServicio = $idServicio;
    }

    function setNombreServicio($nombreServicio) {
        $this->nombreServicio = $nombreServicio;
    }

    function setDescripcionServicio($descripcionServicio) {
        $this->descripcionServicio = $descripcionServicio;
    }

    function setIdArea($idArea) {
        $this->idArea = $idArea;
    }

    function setNombreArea($nombreArea) {
        $this->nombreArea = $nombreArea;
    }


}
