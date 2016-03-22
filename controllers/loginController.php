<?php

class loginController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->_login = $this->loadModel('usuario');
       
    }

    public function index() {
        $this->_view->titulo = 'Login';
        $this->_view->renderizaLogin('login');
        Session::destroy();
        //header('Location: http://www.peg.cl');
    }

    public function ingresar() {
        try {
             echo "OK";
            $user = $this->getTexto('txtLogin');
            $pass = $this->getTexto('txtContraseña');
           
            if (!empty($user) && !empty($pass)) {
             $objUser = $this->_login->getUsuario($user);
             if($objUser){
                if (strtolower($objUser[0]->getUsername()) == $user && $objUser[0]->getPassword() == crypt($pass, 'SMSYS')) {

                    Session::set('SESS_USER', $objUser[0]->getUsername());
                    Session::set('SESS_ID_USER', $objUser[0]->getIduser());
                    Session::set('SESS_ID_TIPO_USER', $objUser[0]->getPerfil_idperfil());
                    Session::set('SESS_NOMBRE', $objUser[0]->getNombre().' '.$objUser[0]->getApellido());
                    Session::set('SESS_CORREO', $objUser[0]->getEmail());
                    if (Session::get('SESS_ERRLOGIN') != null) {
                        Session::destroy('SESS_ERRLOGIN');
                    }
                    if($objUser[0]->getPerfil_idperfil() == 1  || $objUser[0]->getPerfil_idperfil() == 0 ){
                        header('Location: ' . BASE_URL . 'sistema');
                    }
                    else if($objUser[0]->getPerfil_idperfil() == 2){
                        header('Location: ' . BASE_URL . 'sistema');
                    }
                    else if($objUser[0]->getPerfil_idperfil() == 3){
                        header('Location: ' . BASE_URL . 'avance');
                    }
                } else {
                      //Session::set('SESS_ERRLOGIN',$user.' '.$pass);
                    Session::set('SESS_ERRLOGIN', 'Usuario o contraseña incorrectos');
                    header('Location: http://www.peg.cl?cod=1');
                }
            } else {
                    //Session::set('SESS_ERRLOGIN',$user.' '.$pass);
                Session::set('SESS_ERRLOGIN', 'No existe ese usuario registrado');
                header('Location: http://www.peg.cl?cod=2');
            }
            }
            else{
                 Session::set('SESS_ERRLOGIN', 'Los campos no deben ir vacíos');
                  header('Location: http://www.peg.cl?cod=3');
                
               
            }
      
      
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

}
