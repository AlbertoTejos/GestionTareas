<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of avanceDTO
 *
 * @author Beto
 */
class avanceDTO {
   private $id_tarea; 
   private $nombre_proyecto;
   private $nombre_modulo;
   private $nombre_tarea;
   private $desc_tarea;
   private $fecha_inicio;
   private $fecha_fin;
   private $horas_estimadas;
   private $estado;
   private $nivel;
   private $desarrollador;
   private $horas_dia;
   private $nombre_evento;
   private $fecha_reporte;
   
   function getFecha_reporte() {
       return $this->fecha_reporte;
   }

   function setFecha_reporte($fecha_reporte) {
       $this->fecha_reporte = $fecha_reporte;
   }

      
   function getNombre_evento() {
       return $this->nombre_evento;
   }

   function setNombre_evento($nombre_evento) {
       $this->nombre_evento = $nombre_evento;
   }

      
   
   function getId_tarea() {
       return $this->id_tarea;
   }

   function setId_tarea($id_tarea) {
       $this->id_tarea = $id_tarea;
   }

      
   function getNombre_modulo() {
       return $this->nombre_modulo;
   }

   function setNombre_modulo($nombre_modulo) {
       $this->nombre_modulo = $nombre_modulo;
   }

      
   function getNombre_proyecto() {
       return $this->nombre_proyecto;
   }

   function getNombre_tarea() {
       return $this->nombre_tarea;
   }

   function getDesc_tarea() {
       return $this->desc_tarea;
   }

   function getFecha_inicio() {
       return $this->fecha_inicio;
   }

   function getFecha_fin() {
       return $this->fecha_fin;
   }

   function getHoras_estimadas() {
       return $this->horas_estimadas;
   }

   function getEstado() {
       return $this->estado;
   }

   function getNivel() {
       return $this->nivel;
   }

   function getDesarrollador() {
       return $this->desarrollador;
   }

   function getHoras_dia() {
       return $this->horas_dia;
   }

   function setNombre_proyecto($nombre_proyecto) {
       $this->nombre_proyecto = $nombre_proyecto;
   }

   function setNombre_tarea($nombre_tarea) {
       $this->nombre_tarea = $nombre_tarea;
   }

   function setDesc_tarea($desc_tarea) {
       $this->desc_tarea = $desc_tarea;
   }

   function setFecha_inicio($fecha_inicio) {
       $this->fecha_inicio = $fecha_inicio;
   }

   function setFecha_fin($fecha_fin) {
       $this->fecha_fin = $fecha_fin;
   }

   function setHoras_estimadas($horas_estimadas) {
       $this->horas_estimadas = $horas_estimadas;
   }

   function setEstado($estado) {
       $this->estado = $estado;
   }

   function setNivel($nivel) {
       $this->nivel = $nivel;
   }

   function setDesarrollador($desarrollador) {
       $this->desarrollador = $desarrollador;
   }

   function setHoras_dia($horas_dia) {
       $this->horas_dia = $horas_dia;
   }



}
