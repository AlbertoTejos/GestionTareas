<?php

class datosloginController extends Controller {

    public function __construct() {
        parent::__construct();
        //$this->_usuario = $this->loadModel('usuario');
    }

    public function index() {
        $this->_view->titulo = 'Registro';
        //$this->_view->renderizarSistema('datoslogin');
        header('Location: http://www.peg.cl');
    }
}