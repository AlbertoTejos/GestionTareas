<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of avanceController
 *
 * @author Beto
 */
class avanceController extends Controller {

    function __construct() {
        parent::__construct();
        $this->_modelo = $this->loadModel('avance');
    }

    public function index() {

        $usuario = Session::get('SESS_ID_USER');
        
        if ($usuario != null) {

            $this->_view->_tituloPanel = "Tareas solicitadas";
            $this->_view->_titulo = "Monitor de Avances";
            //usuario Dino Sename 
//            $avances = $this->_modelo->getAvances($usuario, 0);
//            $this->_view->_avances = $avances;
//
//            $avances2 = $this->_modelo->getAvances($usuario,0, true);
//            $this->_view->_avances2 = $avances2;
//            
//            
//            $this->_view->_usuario = $usuario;
            $this->_view->renderizarSistema('avance');
            
        } else {
            header('Location: ' . BASE_URL . 'login');
        }
    }
    public function cargar(){
        $usuario = Session::get('SESS_ID_USER');
        
        if ($usuario != null) {

            $this->_view->_tituloPanel = "Tareas solicitadas";
            $this->_view->_titulo = "Monitor de Avances";
            //usuario Dino Sename 
//            $avances = $this->_modelo->getAvances($usuario, 0);
//            $this->_view->_avances = $avances;
//
//            $avances2 = $this->_modelo->getAvances($usuario,0, true);
//            $this->_view->_avances2 = $avances2;
//            
//            
//            $this->_view->_usuario = $usuario;
            $this->_view->renderizaLogin('avance');
            
        } else {
            header('Location: ' . BASE_URL . 'login');
        }
        
    }
    
    public function detalles($idUsuario, $idTarea,  $bol = false) {
        
//        $usuario = Session::get('SESS_ID_USER');
//        
//        if ($bol) {
//            $avances = $this->_modelo->getAvances($usuario,$idTarea, true);
//        }else{
//            $avances = $this->_modelo->getAvances($usuario, $idTarea);
//        }
//        
//        $this->_view->_avances = $avances;
        $this->_view->renderizaCenterBox('detalleAvance');
    }

}
