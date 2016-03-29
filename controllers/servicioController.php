<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of servicioController
 *
 * @author Beto
 */
class servicioController extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->_evento = $this->loadModel('evento');
        $this->_proyecto = $this->loadModel('proyecto');
        $this->_trabajo = $this->loadModel('modulo');
        $this->_modelo = $this->loadModel('servicio');
        $this->_area = $this->loadModel('area');
    }

    public function index() {
        
        $this->_view->_titulo = "Administraci&oacute;n de Servicios";
        $this->_view->_tituloPanel = "Servicios";

        $pagina = filter_input(INPUT_GET, 'pag', FILTER_SANITIZE_SPECIAL_CHARS);
        $orden = filter_input(INPUT_GET, 'orden', FILTER_SANITIZE_SPECIAL_CHARS);
        $cantidadRegistros = filter_input(INPUT_GET, 'reg', FILTER_SANITIZE_SPECIAL_CHARS);

        //Por defecto
        if (empty($orden)) {
            $orden = "asc";
        }

        if (empty($cantidadRegistros)) {
            $cantidadRegistros = 5;
        }

        $this->paginacion($pagina, $orden, $cantidadRegistros);
    }

    function paginacion($pag, $orden, $cantidadRegistros) {

        //Mostrar sólo los primeros X registros
        //$LIMITE = 5;

        if (empty($pag)) {

            //Valores por defecto - Inicio de página
            $inicio = 0;
            $pagina = 1;
        } else {

            $pagina = $pag;
            $inicio = ($pagina - 1) * $cantidadRegistros;
        }



        //Traemos todos los clientes para ver el total de registros
        $servicios = $this->_modelo->getServicios();



        //Filas totales
        $rows = sizeof($servicios);

//        echo $rows;
        //Paginas
        $pags = ceil($rows / $cantidadRegistros);

        $serviciosFiltados = $this->_modelo->pagServicios($inicio, $cantidadRegistros, $orden);

        $this->_view->_paginas = $pags;

        $this->_view->_paginaSeleccionada = $pagina;
        $this->_view->_servicios = $serviciosFiltados;
        $this->_view->renderizarSistema('servicio');
    }
    
    function detalleServicio($id) {
        
        $servicio = $this->_modelo->getServicios($id);
        
        $this->_view->_idServicio = $servicio[0]->getIdServicio();
        $this->_view->_nombre = $servicio[0]->getNombreServicio();
        $this->_view->_descripcion = $servicio[0]->getDescripcionServicio();
        $this->_view->_idArea = $servicio[0]->getIdArea();
        $this->_view->_nombreArea = $servicio[0]->getNombreArea();
        
        $this->_view->renderizaCenterBox('detallesServicio');
    }
    
    function modificar() {
        
        $id = $this->getTexto('txtId');
        $nombre = $this->getTexto('txtNombre');
        $descrpcion = $this->getTexto('txtDescripcion');
        
        if ($this->_modelo->modificar($id, $nombre, $descrpcion)) {
            echo "OK";
        }
        
    }
    
    function eliminar() {
        
        $id = $this->getTexto('txtId');
        if ($this->_modelo->eliminar($id)) {
            echo "OK";
        }
        
    }
    
    function nuevo($idProyecto = null, $idTrabajo = null, $idEvento = null) {
        
//        echo $idProyecto;
//        echo $idTrabajo;
        
        //cargamos los proyectos
        $proyectos = $this->_proyecto->getTodosProyectos();
        $this->_view->_proyectos = $proyectos;
        
        if ($idProyecto != null && ($idTrabajo == null && $idEvento == null)) {
   
            //traemos el trabajo asociado
            $trabajo = $this->_trabajo->getModuloAdm(0, $idProyecto);  
            
            //enviamos el id del proyecto realizado para dejarlo seleccionado
            $this->_view->_proyectoSeleccionado = $idProyecto;
            
             //enviamos los datos para cargar las listas desplegables          
            $this->_view->_trabajo = $trabajo;
            
            
        }else{
            
   
            $trabajo = $this->_trabajo->getModuloAdm(0, $idProyecto);              
            $this->_view->_proyectoSeleccionado = $idProyecto;                 
            $this->_view->_trabajo = $trabajo;
            
           
            $evento = $this->_evento->getEventos(null, $idTrabajo);  
            $this->_view->_trabajoSeleccionado = $idTrabajo;      
            $this->_view->_evento = $evento;
            
            $areas = $this->_area->getAreas(null, $idEvento);
            $this->_view->_eventoSeleccionado = $idEvento;
            $this->_view->_areas = $areas;
            
        }
    
        $this->_view->renderizaCenterBox('nuevoServicio');
    }
    
    function ingresar() {
        
        $proyecto = $this->getTexto('selectProyecto');
        $trabajo = $this->getTexto('selectTrabajo');
        $evento = $this->getTexto('selectEvento');
        $area = $this->getTexto('selectArea');
        $nombre = $this->getTexto('txtNombreServicio');
        $descripcion = $this->getTexto('txtDescripcionServicio');
        
        //echo $evento;
        
        if (isset($proyecto) && isset($trabajo) && isset($evento) && isset($area) && isset($nombre) && isset($descripcion)) {
            $this->_modelo->insertar($nombre, $descripcion, $area);
        }else{
            echo "Debe completar los campos requeridos";
        }            
    }
}
