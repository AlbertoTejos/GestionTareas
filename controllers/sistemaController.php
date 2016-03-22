<?php
class sistemaController extends Controller{
    public function __construct() {
        parent::__construct();
         $this->_proyectos = $this->loadModel('proyecto');
          
    }
    public function index() 
    {
       
       $this->_view->titulo = 'Login';
       if(Session::get('SESS_USER') != null)
        {
           if(Session::get("SESS_ID_USER") != null){
                if(Session::get('SESS_ID_TIPO_USER') != 3){
                 $proy_model = $this->_proyectos->getProductosUsuarios();

                 $this->_view->_proyectosUsuario = $proy_model;

                 $this->_view->renderizarSistema('sistema');
                }
                else{
                    header('Location: ' . BASE_URL . 'avance');
                }
           }
           else{
              header('Location: ' . BASE_URL . 'login'); 
           }
       }
    else{
         header('Location: ' . BASE_URL . 'login');
        }
    }
    public function cargar(){
        
        $this->_view->titulo = 'Login';
       if(Session::get('SESS_USER') != null)
        {
           if(Session::get("SESS_ID_USER") != null){
                if(Session::get('SESS_ID_TIPO_USER') != 3){
                 $proy_model = $this->_proyectos->getProductosUsuarios();

                 $this->_view->_proyectosUsuario = $proy_model;

                 $this->_view->renderizaLogin('sistema');
                }
                else{
                    header('Location: ' . BASE_URL . 'avance');
                }
           }
           else{
              header('Location: ' . BASE_URL . 'login'); 
           }
       }
    else{
         header('Location: ' . BASE_URL . 'login');
        }
    }
    public function abreOrganizacion(){
        
     
     $this->_view->renderizaCenterBox('ingresoTicket');
    }
    
    public function insertOrganizacion(){
        
     $org_descripcion = $this->getTexto('txt_nombreOrganizcion');
     
     
     
     $sql = "INSERT INTO smandb.organizacion(IDORGANIZACION, DESCRIPCION, FECHA, USUARIO_IDUSER)"
             . "VALUES(0, '".$org_descripcion."', CURDATE(), '".Session::get('SESS_ID_USER')."')";   
     $org_model = $this->_organizacion->exeSQL($sql);
     if($org_model){
         
        echo $sql;
     
     }
     else{
         
       throw new Exception('No se ha podido guardar, comuniquese con nuestro staff') ;
        
     }
     // $this->_view->renderizarSistema('sistema');
     
        
    
    }
    
    public function getOrganizaciones(){
  
     $this->_view->renderizaSistema('sistema');   
    }
    
    
     public function redireccionaModelos($cod){
     if(Session::get('SESS_ID_TIPO_USER')== 1 || Session::get('SESS_ID_TIPO_USER')== 0 ){
         Session::set("SESS_CLAVE", $cod);
         $this->redireccionar("modulo");
     }
     else if(Session::get('SESS_ID_TIPO_USER')== 2){
          Session::set("SESS_CLAVE", $cod);
            $this->redireccionar("tarea");
     }
     else{
        $this->redireccionar("index"); 
     }
     
    }
    

}
