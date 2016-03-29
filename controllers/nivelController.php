<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nivelController
 *
 * @author Beto
 */
class nivelController extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->_modelo = $this->loadModel('nivel');
        $this->_proyecto = $this->loadModel('proyecto');
    }
    
    public function index() {
        
        $this->_view->_titulo = "Administraci&oacute;n de Niveles de Criticidad";
        $this->_view->_tituloPanel = "Niveles de Criticidad";

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
        $niveles= $this->_modelo->getNiveles();



        //Filas totales
        $rows = sizeof($niveles);

//        echo $rows;
        //Paginas
        $pags = ceil($rows / $cantidadRegistros);

        $nivelesFiltrados = $this->_modelo->pagAreas($inicio, $cantidadRegistros, $orden);

        $this->_view->_paginas = $pags;

        $this->_view->_paginaSeleccionada = $pagina;
        $this->_view->_niveles = $nivelesFiltrados;
        $this->_view->renderizarSistema('nivel');
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
    
        $this->_view->renderizaCenterBox('nuevoNivel');
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
    
    function detalleNivel($id){
        
        $niveles = $this->_modelo->getNiveles($id);
               
        $this->_view->_idNivel = $niveles[0]->getIdNivel();
        $this->_view->_nombre = $niveles[0]->getNombreNivel();
        $this->_view->_tiempoMaximo = $niveles[0]->getTiempoMaximo();
        $this->_view->_idProyecto = $niveles[0]->getIdProyecto();
        $this->_view->_nombreProyecto = $niveles[0]->getNombreProyecto();
        
        $this->_view->renderizaCenterBox('detallesNivel');
    }
    
    function modificar() {
        
        $id = $this->getTexto('txtId');
        $nombre = $this->getTexto('txtNombre');
        $tiempoMaximo = $this->getTexto('txtTiempoMaximo');
        
        if ($this->_modelo->modificar($id, $nombre, $tiempoMaximo)) {
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
