<?php

class clienteController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->_modelo = $this->loadModel('cliente');
        $this->_modeloProyectos = $this->loadModel('proyecto');
    }

    public function index() {
      if(Session::get("SESS_ID_USER") != null){
          if(Session::get("SESS_ID_TIPO_USER") != 3){
        $this->_view->_titulo = "Administraci&oacute;n de Clientes";
        $this->_view->_tituloPanel = "Clientes";
             
        $pagina = filter_input(INPUT_GET, 'pag', FILTER_SANITIZE_SPECIAL_CHARS);
        $orden = filter_input(INPUT_GET, 'orden', FILTER_SANITIZE_SPECIAL_CHARS);
        $cantidadRegistros = filter_input(INPUT_GET, 'reg', FILTER_SANITIZE_SPECIAL_CHARS);
        
        //Por defecto
        if (empty($orden)) {
            $orden = "asc";
        }
        
        if(empty ($cantidadRegistros)){
            $cantidadRegistros = 5;
        }
     
        $this->paginacion($pagina, $orden, $cantidadRegistros);
      }
      else{      
           header('Location: ' . BASE_URL . 'avance');
      }
      }
      else{      
           header('Location: ' . BASE_URL . 'login');
      }
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
        $clientes = $this->_modelo->getCliente(0);
        
        //Filas totales
        $rows = sizeof($clientes);
        
        //Paginas
        $pags = ceil($rows / $cantidadRegistros);
        
        $clientesFiltados = $this->_modelo->pagClientes($inicio, $cantidadRegistros, $orden);
        
        $this->_view->_paginas = $pags;
        
        $this->_view->_paginaSeleccionada = $pagina;
        $this->_view->_clientes = $clientesFiltados;
        $this->_view->renderizarSistema('cliente');
        
    }

    function nuevo() {
        $this->_view->renderizaCenterBox('nuevoCliente');
    }

    function ingresar() {

        $nombre = $this->getTexto("txtNombre");
        $nombreCorto = $this->getTexto("txtNombreCorto");

        if (isset($nombre) && isset($nombreCorto) && $this->_modelo->insertarCliente($nombre, $nombreCorto)) {
            echo 'OK';
        }else{
            echo 'Debe completar los campos requeridos';
        }
    }

    function eliminar() {

        $id = $this->getTexto("txtId");
        if ($this->_modelo->eliminarCliente($id)) {
            echo 'OK';
        }
        
    }

    function modificar() {

        $id = $this->getTexto("txtId");
        $nombre = $this->getTexto("txtNombre");
        $nombreCorto = $this->getTexto("txtNombreCorto");

        if (isset($id) && isset($nombre) && isset($nombreCorto)) {
            if ($this->_modelo->modificarCliente($id, $nombre, $nombreCorto)) {
                echo 'OK';
            }
        } else {
            echo 'Debe completar los campos requeridos';
        }
    }

    function detalleClientes($id) {

        $clientes = $this->_modelo->getCliente($id);

        $this->_view->_id = $clientes[0]->getId();
        $this->_view->_nombre = $clientes[0]->getNombre();
        $this->_view->_nombreCorto = $clientes[0]->getNombreCorto();

        $proyectos = $this->_modeloProyectos->getProyectos(null, $id);
        $this->_view->_proyectos = $proyectos;

        $this->_view->renderizaCenterBox('detalleClientes');
    }
    function obtienePagina($id){
        
        
    }

}
