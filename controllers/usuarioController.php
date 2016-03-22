<?php

class usuarioController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->_modelo = $this->loadModel('usuario');
    }

    public function index() {
        if (Session::get("SESS_ID_USER") != null) {
            if (Session::get("SESS_ID_TIPO_USER") != 3) {
                $this->_view->_titulo = "Administraci&oacute;n de Usuarios";
                $this->_view->_tituloPanel = "Usuarios";

                $pagina = filter_input(INPUT_GET, 'pag', FILTER_SANITIZE_SPECIAL_CHARS);

                if (empty($pagina)) {
                    $pagina = 1;
                }

                $this->paginacion($pagina);
            } else {
                header('Location: ' . BASE_URL . 'avance');
            }
        } else {
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

        //Traemos todos los clientes para ver el total de registros
        $usuarios = $this->_modelo->getUsuario(null);

        //Filas totales
        $rows = sizeof($usuarios);

        //Paginas
        $pags = ceil($rows / $LIMITE);

        $usuariosFiltados = $this->_modelo->pagUsuarios($inicio, $LIMITE);

        $this->_view->_paginas = $pags;
        $this->_view->_paginaSeleccionada = $pag;
        $this->_view->_usuarios = $usuariosFiltados;
        $this->_view->renderizarSistema('usuario');
    }

    function nuevo() {

        $this->_view->renderizaCenterBox('nuevoUsuario');
    }

    function ingresar() {

        $usuario = $this->getTexto('txtNombreDeUsuario');
        $pass = $this->getTexto('txtPass');
        $nombre = $this->getTexto('txtNombre');
        $apellido = $this->getTexto('txtApellido');
        $correo = $this->getTexto('txtCorreo');
        $tipo = $this->getTexto('selTipo');
        $tipoTra = $this->getTexto('selTipoTra');

        //datos requeridos
        if (isset($usuario) && isset($pass) && isset($nombre) && isset($apellido) && isset($correo)
        ) {
            $this->getLibrary('verify');    
            //$mail = new verify();
        
            //formato correcto y si existe el correo 
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                echo "Dirección de correo inválida.";
            //} else if($mail->verifyEmail($correo, 'atejos@peg.cl') == "invalid"){
                //echo "Dirección de correo no existe";
            } else {
                $this->_modelo->nuevoUsuario(
                        $usuario, crypt($pass, 'SMSYS'), $nombre, $apellido, $correo, $tipo, $tipoTra);
            }
        } else {
            echo 'Debe ingresar los campos requeridos';
        }

//        $usuarios = $this->_modelo->nuevoUsuario(
//                $usuario, $nombre, $pass, $apellido, $correo, $tipo);
//
//        $this->_view->_usuarios = $usuarios;
    }

    function detalleUsuario($nombre) {

        $usuario = $this->_modelo->getUsuario($nombre);
        $this->_view->_usuario = $usuario;
        $this->_view->renderizaCenterBox('detalleUsuario');
    }

    function eliminar($id) {

        if ($this->_modelo->eliminarUsuario($id)) {
            echo 'OK';
        }
    }

    function modificar() {

        $id = $this->getTexto("txtId");
        $usuario = $this->getTexto("txtNombreDeUsuario");
        $contraseña = crypt($this->getTexto('txtPass'), 'SMSYS');
        $perfil = $this->getTexto("txtIdPerfil");
        $correo = $this->getTexto("txtCorreo");

        if (isset($id) && isset($usuario) && isset($correo) && isset($contraseña)) {
            $this->_modelo->modificarUsuario($id, $usuario, $perfil, $correo, $contraseña);
        }
    }

}
