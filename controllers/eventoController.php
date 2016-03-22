<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of eventoController
 *
 * @author Beto
 */
class eventoController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->_modelo = $this->loadModel('evento');
        $this->_proyecto = $this->loadModel('proyecto');
        $this->_trabajo = $this->loadModel('modulo');
    }

    public function index() {
        
        $this->_view->_titulo = "Administraci&oacute;n de Eventos";
        $this->_view->_tituloPanel = "Eventos";

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
        $eventos = $this->_modelo->getEventos();



        //Filas totales
        $rows = sizeof($eventos);

//        echo $rows;
        //Paginas
        $pags = ceil($rows / $cantidadRegistros);

        $eventosFiltados = $this->_modelo->pagEventos($inicio, $cantidadRegistros, $orden);

        $this->_view->_paginas = $pags;

        $this->_view->_paginaSeleccionada = $pagina;
        $this->_view->_eventos = $eventosFiltados;
        $this->_view->renderizarSistema('evento');
    }
    
    function detalleEvento($id) {
        
        $evento = $this->_modelo->getEventos($id);
        
        $this->_view->_idEvento = $evento[0]->getIdEvento();
        $this->_view->_nombre = $evento[0]->getNombreEvento();
        $this->_view->_trabajo = $evento[0]->getNombreTrabajo();
        $this->_view->_proyecto = $evento[0]->getNombreProyecto();
        
        $this->_view->renderizaCenterBox('detalleEvento');
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
    
    function nuevo($idTrabajo = null) {
        
        if ($idTrabajo == null) {
            //cargamos los proyectos
            $proyectos = $this->_proyecto->getTodosProyectos();
            $this->_view->_proyectos = $proyectos;
        }else{
            //cargamos los proyectos
            $proyectos = $this->_proyecto->getTodosProyectos();
            //traemos el trabajo asociado
            $trabajo = $this->_trabajo->getModuloAdm($idTrabajo);
            //enviamos el id del trabajo realizado para dejarlo seleccionado
            $this->_view->_seleccionado = $idTrabajo;
            
             //enviamos los datos para cargar las listas desplegables
            $this->_view->_proyectos = $proyectos;          
            $this->_view->_trabajo = $trabajo[0];
        }
    
        $this->_view->renderizaCenterBox('nuevoEvento');
    }

}
