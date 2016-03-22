<?php

class informeDTO{
   public $idProfesional;
   public $tipo;
   public $hrs; 
   public $sobreEsfuerzo;
   public $fallas;
   public $incidencias;
   public $mejoras;
   
   
   function getIdProfesional() {
       return $this->idProfesional;
   }

   function getTipo() {
       return $this->tipo;
   }

   function getHrs() {
       return $this->hrs;
   }

   function getSobreEsfuerzo() {
       return $this->sobreEsfuerzo;
   }

   function getFallas() {
       return $this->fallas;
   }

   function getIncidencias() {
       return $this->incidencias;
   }

   function getMejoras() {
       return $this->mejoras;
   }

   function setIdProfesional($idProfesional) {
       $this->idProfesional = $idProfesional;
   }

   function setTipo($tipo) {
       $this->tipo = $tipo;
   }

   function setHrs($hrs) {
       $this->hrs = $hrs;
   }

   function setSobreEsfuerzo($sobreEsfuerzo) {
       $this->sobreEsfuerzo = $sobreEsfuerzo;
   }

   function setFallas($fallas) {
       $this->fallas = $fallas;
   }

   function setIncidencias($incidencias) {
       $this->incidencias = $incidencias;
   }

   function setMejoras($mejoras) {
       $this->mejoras = $mejoras;
   }



    
}

