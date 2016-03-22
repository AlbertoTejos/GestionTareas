<?php
class tareaDTO{
    public $idTarea;
    public $nombre;
    public $descripcion;
    public $descripcionTarea;
    public $formulario;
    public $flujoCorrecto;
    public $fechaReporte;
    public $fechaInicio;
    public $fechaTermino;
    public $horasEstimadas;
    public $horasDia;
    public $fechaFinalizacion;
    public $solucionPropuesta;
    public $motivoRechazo;
    public $fechaRechazo;
    public $id_estado;
    public $id_nivel;
    public $nombre_nivel;
    public $id_hito;
    public $id_evento;
    public $nombre_evento;
    public $nombre_admin_asigna;
    public $cantidadDeRecursos;
    public $id_user;
    private $fechaTerminoActividad;
    private $horasDias;
    private $fechaUltimoAvance;
    private $horasEfectivas;
    private $estadoAvance;
    private $fechaContinuacion;
    
    function getFechaContinuacion() {
        return $this->fechaContinuacion;
    }

    function setFechaContinuacion($fechaContinuacion) {
        $this->fechaContinuacion = $fechaContinuacion;
    }

        
    function getFechaUltimoAvance() {
        return $this->fechaUltimoAvance;
    }

    function getHorasEfectivas() {
        return $this->horasEfectivas;
    }

    function getEstadoAvance() {
        return $this->estadoAvance;
    }

    function setFechaUltimoAvance($fechaUltimoAvance) {
        $this->fechaUltimoAvance = $fechaUltimoAvance;
    }

    function setHorasEfectivas($horasEfectivas) {
        $this->horasEfectivas = $horasEfectivas;
    }

    function setEstadoAvance($estadoAvance) {
        $this->estadoAvance = $estadoAvance;
    }

        
    function getHorasDias() {
        return $this->horasDias;
    }

    function setHorasDias($horasDias) {
        $this->horasDias = $horasDias;
    }

        
    function getFechaTerminoActividad() {
        return $this->fechaTerminoActividad;
    }

    function setFechaTerminoActividad($fechaTerminoActividad) {
        $this->fechaTerminoActividad = $fechaTerminoActividad;
    }

        
    function getId_user() {
        return $this->id_user;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

        function getCantidadDeRecursos() {
        return $this->cantidadDeRecursos;
    }

    function setCantidadDeRecursos($cantidadDeRecursos) {
        $this->cantidadDeRecursos = $cantidadDeRecursos;
    }

        
    function getHorasDia() {
        return $this->horasDia;
    }

    function setHorasDia($horasDia) {
        $this->horasDia = $horasDia;
    }

        
    function getNombre_admin_asigna() {
        return $this->nombre_admin_asigna;
    }

    function setNombre_admin_asigna($nombre_admin_asigna) {
        $this->nombre_admin_asigna = $nombre_admin_asigna;
    }

        
    function getNombre_nivel() {
        return $this->nombre_nivel;
    }

    function setNombre_nivel($nombre_nivel) {
        $this->nombre_nivel = $nombre_nivel;
    }

        
    function getNombre_evento() {
        return $this->nombre_evento;
    }

    function setNombre_evento($nombre_evento) {
        $this->nombre_evento = $nombre_evento;
    }

        
    private $nombre_estado;
    
    function getNombre_estado() {
        return $this->nombre_estado;
    }

    function setNombre_estado($nombre_estado) {
        $this->nombre_estado = $nombre_estado;
    }

        
    private $nombreNivel;
    
    function getNombreNivel() {
        return $this->nombreNivel;
    }

    function setNombreNivel($nombreNivel) {
        $this->nombreNivel = $nombreNivel;
    }

 
    function getDescripcionTarea() {
        return $this->descripcionTarea;
    }

    function setDescripcionTarea($descripcionTarea) {
        $this->descripcionTarea = $descripcionTarea;
    }

        
    function getIdTarea() {
        return $this->idTarea;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFormulario() {
        return $this->formulario;
    }

    function getFlujoCorrecto() {
        return $this->flujoCorrecto;
    }

    function getFechaReporte() {
        return $this->fechaReporte;
    }

    function getFechaInicio() {
        return $this->fechaInicio;
    }

    function getFechaTermino() {
        return $this->fechaTermino;
    }

    function getHorasEstimadas() {
        return $this->horasEstimadas;
    }

    function getFechaFinalizacion() {
        return $this->fechaFinalizacion;
    }

    function getSolucionPropuesta() {
        return $this->solucionPropuesta;
    }

    function getMotivoRechazo() {
        return $this->motivoRechazo;
    }

    function getFechaRechazo() {
        return $this->fechaRechazo;
    }

    function getId_estado() {
        return $this->id_estado;
    }

    function getId_nivel() {
        return $this->id_nivel;
    }

    function getId_hito() {
        return $this->id_hito;
    }

    function getId_evento() {
        return $this->id_evento;
    }

    function setIdTarea($idTarea) {
        $this->idTarea = $idTarea;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setFormulario($formulario) {
        $this->formulario = $formulario;
    }

    function setFlujoCorrecto($flujoCorrecto) {
        $this->flujoCorrecto = $flujoCorrecto;
    }

    function setFechaReporte($fechaReporte) {
        $this->fechaReporte = $fechaReporte;
    }

    function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    function setFechaTermino($fechaTermino) {
        $this->fechaTermino = $fechaTermino;
    }

    function setHorasEstimadas($horasEstimadas) {
        $this->horasEstimadas = $horasEstimadas;
    }

    function setFechaFinalizacion($fechaFinalizacion) {
        $this->fechaFinalizacion = $fechaFinalizacion;
    }

    function setSolucionPropuesta($solucionPropuesta) {
        $this->solucionPropuesta = $solucionPropuesta;
    }

    function setMotivoRechazo($motivoRechazo) {
        $this->motivoRechazo = $motivoRechazo;
    }

    function setFechaRechazo($fechaRechazo) {
        $this->fechaRechazo = $fechaRechazo;
    }

    function setId_estado($id_estado) {
        $this->id_estado = $id_estado;
    }

    function setId_nivel($id_nivel) {
        $this->id_nivel = $id_nivel;
    }

    function setId_hito($id_hito) {
        $this->id_hito = $id_hito;
    }

    function setId_evento($id_evento) {
        $this->id_evento = $id_evento;
    }


    
    
    
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

