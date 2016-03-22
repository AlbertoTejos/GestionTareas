<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tareaController
 *
 * @author Beto
 */
class tareaController extends Controller {

    function __construct() {
        parent::__construct();
        $this->_tarea = $this->loadModel("tarea");
        $this->_modulo = $this->loadModel('modulo');
        $this->_estado = $this->loadModel('estado');
        $this->_usuario = $this->loadModel('usuario');
    }

    
    public function index() {
        if (Session::get('SESS_ID_TIPO_USER') != 3) {
            $idUsuario = Session::get('SESS_ID_USER');

            $this->_view->_titulo = "";
            $modulos = $this->_modulo->getModulo(Session::get("SESS_CLAVE"), $idUsuario);
            $modelo_tarea = $this->_tarea;
            $this->_view->_tareas = $modelo_tarea;
            $this->_view->_moduloProyecto = $modulos;
            $this->_view->_usuario = $idUsuario;
            $this->_view->renderizarSistema('mistareas');
        } else {
            header('Location: ' . BASE_URL . 'avance');
        }
    }

    public function cargar() {
        if (Session::get('SESS_ID_TIPO_USER') != 3) {
            $idUsuario = Session::get('SESS_ID_USER');

            $this->_view->_titulo = "";
            $modulos = $this->_modulo->getModulo(Session::get("SESS_CLAVE"), $idUsuario);
            $modelo_tarea = $this->_tarea;
            $this->_view->_tareas = $modelo_tarea;
            $this->_view->_moduloProyecto = $modulos;
            $this->_view->_usuario = $idUsuario;
            $this->_view->renderizaLogin('mistareas');
        } else {
            header('Location: ' . BASE_URL . 'avance');
        }
    }

    public function correoFinalizar($nombreTarea, $fechaFinalizacion, $usuarioNombre, $correo, $correoSession, $nombreSession) {
        $html = file_get_contents(ROOT . 'views' . DS . 'sistema' . DS . 'correos' . DS . 'tareaFinalizada.html');
        $reempl = array('Titulo' => $nombreTarea,
            'nombreUsuario' => $usuarioNombre,
            'FechaFinalizacion' => $fechaFinalizacion,
            'Tipo' => 'Finalizaci&oacute;n de tarea'
        );

        foreach ($reempl as $nombre => $valor) {
            $html = str_replace('{' . $nombre . '}', $valor, $html);
        }

        if (!empty($nombreTarea)) {
            //--------------------------Configuracion Correo---------------------  
            $this->getLibrary('PHPMailerAutoload');
            //$this->getLibrary('class.phpmailer');
            $mail = new PHPMailer();
            $mail->IsMAIL();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "mail.peg.cl";
            $mail->Port = 25;
            $mail->Username = "jreyes@peg.cl";
            $mail->Password = "123DnD123!";
            $mail->SMTPDebug = 1;

            $mail->From = 'jreyes@peg.cl';
            $mail->FromName = 'Finalización de trabajo';
            $mail->CharSet = CHARSET;
            $mail->Subject = 'Finalización de trabajo: ';
            $mail->Body = "";

            $mail->MsgHTML($html);

            $mail->AddBCC($correo, $usuarioNombre);
            $mail->AddBCC($correoSession, $nombreSession);
            if ($mail->Send()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function abreInfoTicket($id) {
        //Session::set("SESS_MODULO", $id);
        //TareaDAO
        $tarea = $this->_tarea->getTareaId($id);
        $this->_view->_It_id_tarea = $id;
        if ($tarea) {
            
            $this->_view->_It_tarea = $tarea[0]->getNombre();
            $this->_view->_It_formulario = $tarea[0]->getFormulario();
            $this->_view->_It_descripcion_problema = $tarea[0]->getDescripcionTarea();
            $this->_view->_It_solucion_propuesta = $tarea[0]->getSolucionPropuesta();
            $this->_view->_It_flujo_correcto = $tarea[0]->getFlujoCorrecto();
            $this->_view->_It_id_estado = $tarea[0]->getId_estado();
            $this->_view->_It_nombre_estado = $tarea[0]->getNombre_estado();
            $this->_view->_It_nombre_evento = $tarea[0]->getNombre_evento();
            $this->_view->_It_nombre_nivel = $tarea[0]->getNombre_nivel();
            $this->_view->_It_horas_estimadas = $tarea[0]->getHorasEstimadas();
            $this->_view->_It_fecha_inicio = $tarea[0]->getFechaInicio();
            $this->_view->_It_fecha_termino = $tarea[0]->getFechaTermino();
            $this->_view->_It_nombre_admin_asigna = $tarea[0]->getNombre_admin_asigna();                  
        }
        
        $avance = $this->_tarea->getAvanceUsuario($id, Session::get("SESS_ID_USER"));
        //nuevos campos de avance
        $this->_view->_It_fecha_ultimo_avance = $avance[0]->getFechaUltimoAvance();
        $this->_view->_It_horas_efectivas = $avance[0]->getHorasEfectivas();
        $this->_view->_It_estado_avance = $avance[0]->getEstadoAvance();
        
        
        //EstadoDAO
        $estado = $this->_estado->getEstado();
        $this->_view->_listEstado = $estado;
        //UsuarioDAO
        $usuario = $this->_usuario->getUsuarioInterno();
        $this->_view->_usuarioInterno = $usuario;
        //Usuario Tarea
        $usuarioTarea = $this->_usuario->getUsuarioTarea($id, Session::get("SESS_ID_USER"));
        if ($usuarioTarea) {
            $this->_view->_fechaAsignacion = $usuarioTarea[0]->getFechaAsignacion();
            $this->_view->_fechaInicio = $usuarioTarea[0]->getFechaInicio();
            $this->_view->_fechaFinalizacion = $usuarioTarea[0]->getFechafinalizacion();
        }

        //$this->_view->_usuarioTarea = $usuarioTarea;

        $this->_view->renderizaCenterBox('informacionTarea');
    }

    public function finalizarTarea($id_tarea, $nombreTarea) {

        $fechaReporte = date('Y.m.d H:i:s');


        $id_usuario = Session::get("SESS_ID_USER");
        $nombre_usuario = Session::get("SESS_NOMBRE");
        //$correo = Session::get("SESS_CORREO");
        $sql = "UPDATE tarea_usuario set fechaFinalizacion = current_timestamp() where Tarea_idTarea = " . $id_tarea . " and Usuario_idUsuario = " . $id_usuario . ";";

//        $usuarioTarea = $this->_usuario->getUsuarioTarea($id_tarea);
//            
//        $nombre = $usuarioTarea[0]->getNombre()." ".$usuarioTarea[0]->getApellido();
//        $correo = $usuarioTarea[0]->getEmail();
        if ($this->_modulo->exeSQL($sql)) {

            //if($this->correoFinalizar($nombreTarea, $fechaReporte, $nombre, $correo, 'jreyes@peg.cl', $nombre_usuario)){
            echo "OK";
            //}
            //else{
            //    echo "No se pudo enviar el correo";
            //}
        } else {
            echo 'No se ha podido dejar en estado en proceso, comuníquese con el administrador';
        }
    }

    public function iniciarTarea($id_tarea) {

        $id_usuario = Session::get("SESS_ID_USER");
        
        $fechaActual = date("Y-m-d 00:00:00");        

        //verificamos si es una mejora para ingresar la fecha de avance
        $tarea = $this->_tarea->getTareaId($id_tarea);
        $evento = $tarea[0]->getNombre_evento();
        
        if ($evento == "Mejora") {
            $query = "UPDATE tarea_usuario set horasEfectivas = '" . $fechaActual . "', fechaUltimoAvance = current_timestamp(), estadoAvance = 'P' where Tarea_idTarea = " . $id_tarea . " and Usuario_idUsuario = " . $id_usuario;

            if ($this->_modulo->exeSQL($query)) {
                
            } else {
                echo "Error en la insercion del avance";
            }
        }
        
        $sql = "UPDATE tarea_usuario set fechaInicio = current_timestamp() where Tarea_idTarea = " . $id_tarea . " and Usuario_idUsuario = " . $id_usuario;
        $sql1 = "UPDATE tarea set Estado_idEstado = 3 where idTarea = " . $id_tarea . "";

        if ($this->_modulo->exeSQL($sql)) {
            if ($this->_modulo->exeSQL($sql1)) {
                echo "OK";
            }
        } else {
            echo 'No se ha podido iniciar la tarea, comuníquese con el administrador';
        }
    }

    function pausarTarea($idTarea) {   
        
        date_default_timezone_set('America/Santiago');
        $id_usuario = Session::get("SESS_ID_USER");
       
        $avance = $this->_tarea->getAvanceUsuario($idTarea, $id_usuario);
        
        $fechaContinuacion = $avance[0]->getFechaContinuacion();
        
        $time = strtotime($fechaContinuacion);
        $dt = new DateTime();
        $dt->setTimestamp($time);
        
        $fechaActual = new DateTime();
        //comparamos la fecha desde que se continuó hasta que se hizo la pausa
        $horasEfectivas = $dt->diff($fechaActual)->format("0000-00-00 %H:%I:%S");
        
        //sacamos la fecha, las horas y los muinutos
        $horas = substr($horasEfectivas, -8, 2);
        $minutos = substr($horasEfectivas, -5, 2);
        $segundos = substr($horasEfectivas, -2);  
        
        //trabajé x horas: x minutos: x segundos
        
        //insertamos las horas efectivas de trabajo      
        $query = "UPDATE tarea_usuario set fechaUltimoAvance = current_timestamp(), horasEfectivas = DATE_ADD(DATE_ADD(DATE_ADD(horasEfectivas, INTERVAL " . $horas . " HOUR), INTERVAL " . $minutos . " MINUTE), INTERVAL " . $segundos . " SECOND), estadoAvance = 'P' where Tarea_idTarea = " . $idTarea . " and Usuario_idUsuario = " . $id_usuario;

        if($this->_modulo->exeSQL($query)){
            echo "OK";
        }else{
            echo "Ocurrio un error al intentar pausar la tarea";
        }
    }
    
    function continuarTarea($idTarea) {
        
//        $fechaActual = new DateTime();     
//        Session::set("FECHA_CONTINUACION", $fechaActual);
        
        $id_usuario = Session::get("SESS_ID_USER");
        $query = "UPDATE tarea_usuario set estadoAvance = 'T', fechaContinuacion = current_timestamp() where Tarea_idTarea = " . $idTarea . " and Usuario_idUsuario = " . $id_usuario;

        if($this->_modulo->exeSQL($query)){
            echo "OK";
        }else{
            echo "Ocurrio un error al intentar continuar la tarea";
        }
    }

}
