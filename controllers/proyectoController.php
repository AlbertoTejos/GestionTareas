<?php

class proyectoController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->_modelo = $this->loadModel('proyecto');
        $this->_modeloModulo = $this->loadModel('modulo');
        $this->_modeloCliente = $this->loadModel('cliente');
    }

    public function index() {
       if(Session::get("SESS_ID_USER")!= null){
           if(Session::get("SESS_ID_TIPO_USER") != 3){
            $this->_view->_titulo = "Administraci&oacute;n de Proyectos";
            $this->_view->_tituloPanel = "Proyectos";

            $pagina = filter_input(INPUT_GET, 'pag', FILTER_SANITIZE_SPECIAL_CHARS);

            if (empty($pagina)) {
                $pagina = 1;
            }

            $this->paginacion($pagina);
           }
           else{
               header('Location: ' . BASE_URL . 'avance');
           }
       }
       else{
           header('Location: ' . BASE_URL . 'login');
       }
    }
    
    function paginacion($pag) {
        
        //Mostrar sólo los primeros X registros
        $LIMITE = 5;

        if (empty($pag)) {
            
            //Valores por defecto - Inicio de página
            $inicio = 0;
            $pagina = 1;
            
        } else {
            
            $pagina = $pag;
            $inicio = ($pagina - 1) * $LIMITE;
        }
       
        //Traemos todos los proyectos para ver el total de registros
        $proyectos = $this->_modelo->getProyectos(null, null);
        
        //Filas totales
        $rows = sizeof($proyectos);
        
        //Paginas
        $pags = ceil($rows / $LIMITE);
        
        $proyectosFiltados = $this->_modelo->pagProyectos($inicio, $LIMITE);
        
        
        $this->_view->_paginas = $pags;
        $this->_view->_paginaSeleccionada = $pag;
        $this->_view->_proyectos = $proyectosFiltados;
        $this->_view->renderizarSistema('proyecto');
        
    }

    function nuevo() {

        $clientes = $this->_modeloCliente->getCliente(0);
        $this->_view->_clientes = $clientes;
        $this->_view->renderizaCenterBox('nuevoProyecto');
    }

    function ingresar() {

        $nombre = $this->getTexto("txtNombre");
        $nemo = $this->getTexto("txtNemo");
        $cliente = $this->getTexto("selectClientes");

        if (isset($nombre) && isset($nemo) && isset($cliente) &&
                $this->_modelo->insertarProyecto($nombre, $nemo, $cliente)) {
            echo 'OK';
        }else{
            echo 'Debe completar los campos requeridos';
        }
    }

    function eliminar() {

        $id = $this->getTexto("txtId");
        if ($this->_modelo->eliminarProyecto($id)) {
            echo 'OK';
        }else{
            echo "Error en la consulta";
        }
    }

    function modificar() {

        $id = $this->getTexto("txtId");
        $nombre = $this->getTexto("txtNombre");
        $nemo = $this->getTexto("txtNemo");

        if (isset($id) && isset($nombre) && isset($nemo)) {
            if ($this->_modelo->modificarProyecto($id, $nombre, $nemo)) {
                echo 'OK';
            }
        } else {
            echo 'Debe completar los campos requeridos';
        }
    }

    function detalleProyectos($id) {

        $proyecto = $this->_modelo->getProyectos($id, null);
        $modulos = $this->_modeloModulo->getModulo($id, null);

        if ($proyecto) {
            $this->_view->_id = $proyecto[0]->getId_Producto();
            $this->_view->_nombre = $proyecto[0]->getNombre();
            $this->_view->_nemo = $proyecto[0]->getNemo();
            $this->_view->_nombreCliente = $proyecto[0]->getCliente();
        }
        
         $this->_view->_hitos = $modulos;
        
        
        $this->_view->renderizaCenterBox('detalleProyecto');
    }

}
