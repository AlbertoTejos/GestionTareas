<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of areaController
 *
 * @author Beto
 */
class areaController extends Controller{
    
    public function __construct() {
        parent::__construct();
        $this->_modelo = $this->loadModel('area');
        $this->_proyecto = $this->loadModel('proyecto');
        $this->_trabajo = $this->loadModel('modulo');
        $this->_evento = $this->loadModel('evento');
    }
    
    public function index() {
        
        $this->_view->_titulo = "Administraci&oacute;n de Áreas";
        $this->_view->_tituloPanel = "Áreas";

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
        $areas = $this->_modelo->getAreas();



        //Filas totales
        $rows = sizeof($areas);

//        echo $rows;
        //Paginas
        $pags = ceil($rows / $cantidadRegistros);

        $areasFiltadas = $this->_modelo->pagAreas($inicio, $cantidadRegistros, $orden);

        $this->_view->_paginas = $pags;

        $this->_view->_paginaSeleccionada = $pagina;
        $this->_view->_areas = $areasFiltadas;
        $this->_view->renderizarSistema('area');
    }
    
    //modificar
    function nuevo($idProyecto = null, $idTrabajo = null) {
        
//        echo $idProyecto;
//        echo $idTrabajo;
        
        //cargamos los proyectos
        $proyectos = $this->_proyecto->getTodosProyectos();
        $this->_view->_proyectos = $proyectos;
        
        if ($idProyecto != null && $idTrabajo == null) {
   
            //traemos el trabajo asociado
            $trabajo = $this->_trabajo->getModuloAdm(0, $idProyecto);  
            
            //enviamos el id del proyecto realizado para dejarlo seleccionado
            $this->_view->_proyectoSeleccionado = $idProyecto;
            
             //enviamos los datos para cargar las listas desplegables          
            $this->_view->_trabajo = $trabajo;
            
            
        }else{
            
            //traemos el trabajo asociado
            $trabajo = $this->_trabajo->getModuloAdm(0, $idProyecto);  
            
            //enviamos el id del proyecto realizado para dejarlo seleccionado
            $this->_view->_proyectoSeleccionado = $idProyecto;
            
             //enviamos los datos para cargar las listas desplegables          
            $this->_view->_trabajo = $trabajo;
            
            //traemos el evento asociado
            $evento = $this->_evento->getEventos(null, $idTrabajo);  
            
            //echo var_dump($evento);
            
            //enviamos el id del trabajo realizado para dejarlo seleccionado
            $this->_view->_trabajoSeleccionado = $idTrabajo;
            
             //enviamos los datos para cargar las listas desplegables          
            $this->_view->_evento = $evento;
            
        }
    
        $this->_view->renderizaCenterBox('nuevaArea');
    }
    
    function ingresar(){
        
        $proyecto = $this->getTexto('selectProyecto');
        $trabajo = $this->getTexto('selectTrabajo');
        $evento = $this->getTexto('selectEvento');
        $area = $this->getTexto('txtArea');
        
        if (isset($proyecto) && isset($trabajo) && isset($evento) && isset($area)) {
            $this->_modelo->insertar($evento, $area);
        }else{
            echo "Debe completar los campos requeridos";
        }
    }
    
    function detalleArea($id){
        
        $areas = $this->_modelo->getAreas($id);
               
        $this->_view->_idArea = $areas[0]->getIdArea();
        $this->_view->_nombre = $areas[0]->getNombre();
        $this->_view->_idEvento = $areas[0]->getIdEvento();
        $this->_view->_nombreEvento = $areas[0]->getNombreEvento();
        
        $this->_view->renderizaCenterBox('detallesArea');
    }
    
    function modificar() {
        
        $id = $this->getTexto('txtId');
        $nombre = $this->getTexto('txtNombre');
        
        if ($this->_modelo->modificar($id, $nombre)) {
            echo "OK";
        }
        
    }
    
    function eliminar() {
        
        $id = $this->getTexto('txtId');
        if ($this->_modelo->eliminar($id)) {
            echo "OK";
        }
        
    }

}
