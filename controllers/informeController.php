<?php

class informeController extends Controller {

    public function __construct() {
        parent::__construct();

        $this->_informe = $this->loadModel('informe');
    }

    public function index() {
        $horasIngeniero = 0;

        $horasAnalista = 0;

        $horasIngenieroRestantes = 0;

        $horasAnalistaRestantes = 0;

        $horasTotalContratadas = 2000;
        
        $horasTotalAFinanciero= 200;
        
        $horasAsesorFinanciero = 0;
        
        $horasAFinancieroRestantes = 0;

        //enlaza el codigo php a la vista que se mostrara
        //realiza las validaciones de seguridad
        if (Session::get('SESS_USER') != null) {
            if (Session::get("SESS_ID_TIPO_USER") != 2) {

                $this->_view->_titulo = "Horas realizadas";

                $this->_view->_tituloPanel = "INFORME TAREAS ABIERTAS";

                $informe = $this->_informe->getInformeHorasByTpoProfesional(Session::get('SESS_FI'), Session::get('SESS_FT'));

                //echo var_dump($informe);
                $informe2 = $this->_informe->getInformeHorasByTpoProfesional(Session::get('SESS_FI'), Session::get('SESS_FT'));

                $this->_view->_informesByProfesional = $informe2;
//                echo var_dump($informe);   
                $this->_view->_informesTipoProfesional = $informe;              

                foreach ($informe as $q) {

                    
                    if ($q->getTipo() == "Analista") {
 
                        $horasAnalista = $q->getHrs();
                        $this->_view->_horasAnalista = $horasAnalista;
                    }
                    if ($q->getTipo() == "Ingeniero") {
                         //echo("111111111111");   
                        $horasIngeniero = $q->getHrs();
                        $this->_view->_horasIngeniero = $horasIngeniero;
                    }
                    
                  if ($q->getTipo() == "Asesor Financiero") {

                        $horasAsesorFinanciero = $q->getHrs();
                        $this->_view->_horasAFiananciero = $horasAsesorFinanciero;
                    }
                }

                $horasIngenieroRestantes = $horasTotalContratadas - $horasIngeniero;
                $this->_view->_horasIngenieroRestante = $horasIngenieroRestantes;

                $this->_view->_horasAnalista = $horasAnalista;

                $horasAnalistaRestantes = $horasTotalContratadas - $horasAnalista;
                
                $this->_view->_horasAnalistaRestante = $horasAnalistaRestantes;
                
                $horasAFinancieroRestantes = $horasTotalAFinanciero - $horasAsesorFinanciero;
                
                $this->_view->_horasAFinancieroRestante = $horasAFinancieroRestantes;


                $this->_view->renderizarSistema('informe');
            } else {
                header('Location: ' . BASE_URL . 'sistema');
            }
        } else {
            header('Location: ' . BASE_URL . 'login');
        }
    }
    
    public function cargar(){
        
         $horasIngeniero = 0;

        $horasAnalista = 0;

        $horasIngenieroRestantes = 0;

        $horasAnalistaRestantes = 0;

        $horasTotalContratadas = 2000;
        
        $horasTotalAFinanciero= 200;
        
        $horasAsesorFinanciero = 0;
        
        $horasAFinancieroRestantes = 0;

        //enlaza el codigo php a la vista que se mostrara
        //realiza las validaciones de seguridad
        if (Session::get('SESS_USER') != null) {
            if (Session::get("SESS_ID_TIPO_USER") != 2) {

                $this->_view->_titulo = "Horas realizadas";

                $this->_view->_tituloPanel = "INFORME TAREAS ABIERTAS";

                $informe = $this->_informe->getInformeHorasByTpoProfesional(Session::get('SESS_FI'), Session::get('SESS_FT'));

                //echo var_dump($informe);
                $informe2 = $this->_informe->getInformeHorasByTpoProfesional(Session::get('SESS_FI'), Session::get('SESS_FT'));

//                        $se = Session::get('SESS_FI');
//                        $se2 = Session::get('SESS_FT');
//                        
//                        echo $se;
//                        echo $se2;

                $this->_view->_informesByProfesional = $informe2;
                //echo var_dump($informe2);   
                $this->_view->_informesTipoProfesional = $informe;

                

                foreach ($informe as $q) {

                    
                    if ($q->getTipo() == "Analista") {
 
                        $horasAnalista = $q->getHrs();
                        $this->_view->_horasAnalista = $horasAnalista;
                    }
                    if ($q->getTipo() == "Ingeniero") {
                         //echo("111111111111");   
                        $horasIngeniero = $q->getHrs();
                        $this->_view->_horasIngeniero = $horasIngeniero;
                    }
                    
                  if ($q->getTipo() == "Asesor Financiero") {

                        $horasAsesorFinanciero = $q->getHrs();
                        $this->_view->_horasAFiananciero = $horasAsesorFinanciero;
                    }
                }

                $horasIngenieroRestantes = $horasTotalContratadas - $horasIngeniero;
                $this->_view->_horasIngenieroRestante = $horasIngenieroRestantes;

                $this->_view->_horasAnalista = $horasAnalista;

                $horasAnalistaRestantes = $horasTotalContratadas - $horasAnalista;
                
                $this->_view->_horasAnalistaRestante = $horasAnalistaRestantes;
                
                $horasAFinancieroRestantes = $horasTotalAFinanciero - $horasAsesorFinanciero;
                
                $this->_view->_horasAFinancieroRestante = $horasAFinancieroRestantes;


                $this->_view->renderizarLogin('informe');
            } else {
                header('Location: ' . BASE_URL . 'sistema');
            }
        } else {
            header('Location: ' . BASE_URL . 'login');
        }
    }

    public function buscarHorasRealizadas() {
        Session::set('SESS_FI', $this->getTexto("fechaIncioInicio"));
        Session::set('SESS_FT', $this->getTexto("fechaTerminoInicio"));
        
        
        
        //$this->_view->renderizarSistema('informe');
        $this->redireccionar('informe');
    }

}
