<?php

class moduloController extends Controller {

    public static $variable = false;

    static function getVariable() {
        return self::$variable;
    }

    static function setVariable($variable) {
        self::$variable = $variable;
    }

    public function __construct() {
        parent::__construct();
        $this->_proyecto = $this->loadModel('proyecto');
        $this->_modulo = $this->loadModel('modulo');
        $this->_tarea = $this->loadModel('tarea');
        $this->_usuario = $this->loadModel('usuario');
        $this->_estado = $this->loadModel('estado');
        $this->_archivo = $this->loadModel('archivo');
    }

    public function index() {

        $orden = filter_input(INPUT_GET, 'orden', FILTER_SANITIZE_SPECIAL_CHARS);

        $this->_view->titulo = 'Administrador de Trabajos';
        // echo Session::get("SESS_CLAVE");
        if (Session::get("SESS_CLAVE") != null) {
            //3 = usuario cliente (sename)
            if (Session::get("SESS_ID_TIPO_USER") != 3) {
                $modulo_model = $this->_modulo->getModuloSist(Session::get("SESS_CLAVE"));
                $this->_view->_moduloProyecto = $modulo_model;
                $tarea_model = $this->_tarea;
                $this->_view->_tarea = $tarea_model;
                $this->_view->_orden = $orden;
                $this->_view->renderizarSistema('modulo');
            }
        } else {

            header('Location: ' . BASE_URL . 'avance');
        }
        //Session::destroy();
    }

//    function cargar($cod, $divBlock, $flag) {
//
////        echo $cod . '_______';
//        //almacenamos el id del div a bloquear
////        if ($flag != null) {
////
////            echo '<script type="text/javascript">'
////            , 'crearDiv("' . $divBlock . '");'
////            , '</script>'
////            ;
////        }
//
//        if ($cod == 2) {
//            $this->setVariable(false);
//        } else {
//            //abri el modal, no esta disponible para otro cliente que ejecute la misma accion
//            $this->setVariable(true);
//        }
//
//        if ($this->getVariable() != false) {
//
//
//            //mantengo el estado para igual para mi
//
//            $orden = filter_input(INPUT_GET, 'orden', FILTER_SANITIZE_SPECIAL_CHARS);
//
//            $this->_view->titulo = 'Administrador de Módulos';
//
//            $modulo_model = $this->_modulo->getModuloSist(Session::get("SESS_CLAVE"));
//            $this->_view->_moduloProyecto = $modulo_model;
//            $tarea_model = $this->_tarea;
//            $this->_view->_tarea = $tarea_model;
//            $this->_view->_orden = $orden;
//            $this->_view->renderizarSistema('modulo');
//            
//            
//        } else {
//
//
//            $orden = filter_input(INPUT_GET, 'orden', FILTER_SANITIZE_SPECIAL_CHARS);
//
//            $this->_view->titulo = 'Administrador de Módulos';
//
//            $modulo_model = $this->_modulo->getModuloSist(Session::get("SESS_CLAVE"));
//            $this->_view->_moduloProyecto = $modulo_model;
//            $tarea_model = $this->_tarea;
//            $this->_view->_tarea = $tarea_model;
//            $this->_view->_orden = $orden;
//            $this->_view->renderizaLogin('modulo');
//        }
//    }

    /* Inicio Abre modales */

    function paginacion($pag, $orden, $cantidadRegistros) {

        //Mostrar sólo los primeros X registros
        //$LIMITE = 5;

        $adm_modulo = $this->_proyecto->getProductosUsuarios();
        $modulos = $this->_modulo->getModuloAdm(0, 0);
        $this->_view->_getModulo = $adm_modulo;

        if (empty($pag)) {

            //Valores por defecto - Inicio de página
            $inicio = 0;
            $pagina = 1;
        } else {

            $pagina = $pag;
            $inicio = ($pagina - 1) * $cantidadRegistros;
        }

        //Traemos todos los modulos para ver el total de registros
        //$modulos = $this->_modulo->getTodosModulos();
        //Filas totales
        $rows = sizeof($modulos);

        //Paginas
        $pags = ceil($rows / $cantidadRegistros);


        $modulosFiltados = $this->_modulo->pagModulos($inicio, $cantidadRegistros, $orden);

        $this->_view->_paginas = $pags;
        $this->_view->_paginaSeleccionada = $pagina;
        //$this->_view->_modulos = $modulosFiltados;
        $this->_view->_getModuloAdm = $modulosFiltados;

        $this->_view->renderizarSistema('admModulo');
    }

    public function abreTicket($id) {
        Session::set("SESS_MODULO", $id);
        $this->_view->renderizaCenterBox('ingresoTicket');
    }

    public function abreInfoTicket($id) {
        Session::set("SESS_MODULO", $id);
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
            $this->_view->_It_id_hito = $tarea[0]->getId_hito();
            $this->_view->_horas_estimadas = $tarea[0]->getHorasEstimadas();
            $this->_view->_It_nombre_evento = $tarea[0]->getNombre_evento();
            $this->_view->_It_nombre_nivel = $tarea[0]->getNombre_nivel();
            $this->_view->_It_Fecha_reporte = $tarea[0]->getFechaReporte();
            $this->_view->_It_id_user_clie = $tarea[0]->getId_user();
            $this->_view->_It_Fecha_inicio = $tarea[0]->getFechaInicio();
            $this->_view->_It_Fecha_termino = $tarea[0]->getFechaTermino();
            $this->_view->_It_Fecha_termino_actividad = $tarea[0]->getFechaTerminoActividad();
            $this->_view->_It_Horas_dias = $tarea[0]->getHorasDias();
        }
        //EstadoDAO
        $estado = $this->_estado->getEstado();
        $this->_view->_listEstado = $estado;
        //UsuarioDAO
        $usuario = $this->_usuario->getUsuarioInterno();
        $this->_view->_usuarioInterno = $usuario;
        //UsuarioTarea
        $idUsuario = Session::get("SESS_ID_USER");
        $usuarioTarea = $this->_usuario->getUsuarioTarea($id, 0);
        $this->_view->_usuarioTarea = $usuarioTarea;

        $usuarioTareaLista = $this->_usuario->getUsuarioTarea($id, 0);
        $this->_view->_usuarioTareaLista = $usuarioTareaLista;
        $this->_view->renderizaCenterBox('informacionTicket');
    }

    public function abreAdmModulo() {

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

    public function abreInsertModulo() {
        $adm_modulo = $this->_proyecto->getTodosProyectos();
        $this->_view->_getModulo = $adm_modulo;
        $this->_view->renderizaCenterBox('admModuloInsert');
    }

    public function abreSolicitudTareas() {
        $adm_modulo = $this->_proyecto->getProductosUsuarios();
        $this->_view->_getModulo = $adm_modulo;
        $this->_view->renderizaCenterBox('solicitudTarea');
    }

    public function abreModificaModulo($id) {
        $modulos = $this->_modulo->getModuloAdm($id, 0);
        $id_hito = 0;
        if ($modulos) {
            $this->_view->_MmId = $modulos[0]->getIdHito();
            $this->_view->_MmNombre = $modulos[0]->getNombre();
            $this->_view->_MmIdProyecto = $modulos[0]->getIdProducto();
            $this->_view->_MmNombreProyecto = $modulos[0]->getNombreProducto();
            $this->_view->_MmEstado = $modulos[0]->getEstado();
            $id_hito = $modulos[0]->getIdHito();
        }

//        $tarea_model = $this->_tarea->getTarea($id_hito, null);
//        $this->_view->_tarea = $tarea_model;
        $this->_view->renderizaCenterBox('modificarModulo');
    }

    /* Fin Abre modales */

    public function insertTicket() {
        $fechaReporte = date('Y.m.d');
        //echo $fechaReporte;
        $modulo = Session::get("SESS_MODULO");
        $nombreTicket = $this->getTexto("it_txtNombreTicket");
        $formularioObjetivo = $this->getTexto("it_txtFormularioObjetivo");
        $descripcionProblema = $this->getTexto("it_txtaDescripcionProblema");
        $solucionPropuesta = $this->getTexto("it_txtaSolucionPropuesta");
        $flujoCorrecto = $this->getTexto("it_txtaFlujoCorrecto");
        $tipologia = $this->getTexto("rdbtnTipoologia");
        $prioridad = $this->getTexto("rdbtnPrioridad");
        $sql = "INSERT INTO tarea(`nombre`,`descripcion`,`formulario`,`flujoCorrecto`,`fechaReporte`,`solucionPropuesta`,
                `Estado_idEstado`,`Nivel_idNivel`,`Hito_idHito`,`Evento_idEvento`,id_usuario_crea_tarea)
                VALUES('" . $nombreTicket . "',
                '" . $descripcionProblema . "','" . $formularioObjetivo . "',
                '" . $flujoCorrecto . "','" . $fechaReporte . "',
                '" . $solucionPropuesta . "',1," . $prioridad . "," . $modulo . "," . $tipologia . "," . Session::get('SESS_ID_USER') . ");";
        $consulta = $this->_tarea->exeSQL($sql);
        if ($consulta) {

            //if ($this->correo($nombreTicket, $descripcionProblema, $fechaReporte, 'Solicitud de tarea', Session::get('SESS_NOMBRE'), 'jreyes@peg.cl')) {
            echo "OK";
            //} else {
            //echo "No se pudo enviar el correo";
            //}
        } else {
            echo 'No se pudo insertar la tarea';
        }
        //echoS 'OK';
    }

    public function insertModulo() {
        $nombre = $this->getTexto("inputName");
        $id = $this->getTexto("selectProducto");

        $sql = "INSERT INTO trabajo(tipificacion, Producto_idProducto) values ('" . $nombre . "', " . $id . ");";
//        echo $sql;

        $consulta = $this->_tarea->exeSQL($sql);
        if ($consulta && isset($nombre) && isset($id)) {
            echo "OK";
        } else {
            echo 'Debe ingresar los campos requeridos';
        }
        //echoS 'OK';
    }

    public function eliminarTrabajo() {

        $id = $this->getTexto('Mm_id_hito');
        $sql = "delete from trabajo where idTrabajo = " . $id;

        if ($this->_tarea->exeSQL($sql)) {
            echo "OK";
        }
    }

    public function validaInsertModulo($nombre, $id) {
        if (!$nombre) {
            echo "Ingrese un nombre para el Trabajo";
        }
        if (!$id) {
            echo "Seleccione un Proyecto";
        }

        return true;
    }

    public function comboHitos($id) {

        $adm_modulo = $this->_modulo->getModuloSist($id);
        $hito = "";
        foreach ($adm_modulo as $mod) {
            $hito .= "<option value='" . $mod->getIdHito() . "'>" . utf8_encode($mod->getNombre()) . "</option>";
        }
        echo $hito;
        //$this->_view->renderizaCenterBox('solicitudTarea');
    }

    public function correo($nombreTarea, $descripcionTarea, $fechaReporte, $horaReporte, $tipo, $usuarioNombre, $correo, $nombrePrioridad, $nombreTipologia, $ultimoId) {
        $html = file_get_contents(ROOT . 'views' . DS . 'sistema' . DS . 'correos' . DS . 'tarea.html');
        $reempl = array('Titulo' => $nombreTarea,
            'descripcionTarea' => $descripcionTarea,
            'FechaReporte' => $fechaReporte,
            'Hora' => $horaReporte,
            'Tipo' => $tipo,
            'NombreApellidoUser' => $usuarioNombre,
            'Nivel' => $nombrePrioridad,
            'Evento' => $nombreTipologia,
            'Id' => $ultimoId
        );

        foreach ($reempl as $nombre => $valor) {
            $html = str_replace('{' . $nombre . '}', $valor, $html);
        }

        if (!empty($nombreTarea)) {
            //--------------------------Configuracion Correo---------------------  
            $this->getLibrary('class.phpmailer');
            $this->getLibrary('PHPMailerAutoload');

            $mail = new PHPMailer();
            $mail->IsMAIL();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "mail.peg.cl";
            $mail->Port = 25;
            $mail->Username = "jreyes@peg.cl";
            $mail->Password = "123DnD123!";
            $mail->SMTPDebug = 1;

            $mail->From = 'contacto@peg.cl';
            $mail->FromName = 'Workzilla, Sistema gestor de tareas';
            $mail->CharSet = CHARSET;
            $mail->Subject = 'Solicitud de trabajo: ';
            $mail->Body = "";

            $mail->MsgHTML($html);

            $mail->addBCC($correo, $usuarioNombre);
            $mail->addBCC('mvalenzuela@peg.cl', 'Marco Valenzuela');
            $mail->addBCC('jreyes@peg.cl', 'Jaime Reyes');
            $mail->addBCC('atejos@peg.cl', 'Alberto Tejos');
            $mail->addBCC('jvalenzuela@peg.cl', 'Juan Valenzuela');
            $mail->addBCC('mcofre@peg.cl', 'Marcelo Cofré');


            if ($mail->Send()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function correoIniciar($nombreTarea, $id_tarea, $fechaInicio, $fechaTermino, $fechaAsignacion, $fechaFinalizacion, $usuarioNombre, $horas, $correo, $correoSession, $nombreUsuario, $correoClie, $nombreUsuarioClie, $nombrePrioridad, $nombreTipologia, $fechaReporte, $descripcionAdmin, $horasDias) {
        $html = file_get_contents(ROOT . 'views' . DS . 'sistema' . DS . 'correos' . DS . 'tareaIniciada.html');
        $reempl = array('Tipo' => 'Inicio de Tarea',
            'Id' => $id_tarea,
            'FechaHoraSol' => $fechaReporte,
            'TareaSolicitada' => $nombreTarea,
            'Nivel' => $nombrePrioridad,
            'Evento' => $nombreTipologia,
            'UsClie' => $nombreUsuarioClie,
            'FechaInicio' => $fechaInicio,
            'DescripcionAdmin' => $descripcionAdmin,
            'Nivel1' => $nombrePrioridad,
            'Evento1' => $nombreTipologia,
            'Horas' => $horasDias
        );

        foreach ($reempl as $nombre => $valor) {
            $html = str_replace('{' . $nombre . '}', $valor, $html);
        }

        if (!empty($nombreTarea)) {
            //--------------------------Configuracion Correo---------------------  
            $this->getLibrary('PHPMailerAutoload');
            $mail = new PHPMailer();
            $mail->IsMAIL();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "mail.peg.cl";
            $mail->Port = 25;
            $mail->Username = "jreyes@peg.cl";
            $mail->Password = "123DnD123!";
            $mail->SMTPDebug = 1;

            $mail->From = 'contacto@peg.cl';
            $mail->FromName = 'Workzilla, Sistema gestor de tareas';
            $mail->CharSet = CHARSET;
            $mail->Subject = 'Inicio de tarea: ';
            $mail->Body = "";

            $mail->MsgHTML($html);

//            $mail->addBCC($correo, $usuarioNombre);
//            $mail->addBCC($correoSession, $nombreUsuario);
            $mail->addBCC($correoClie, $nombreUsuarioClie);
            $mail->addBCC('mvalenzuela@peg.cl', 'Marco Valenzuela');
            $mail->addBCC('jreyes@peg.cl', 'Jaime Reyes');
            $mail->addBCC('atejos@peg.cl', 'Alberto Tejos');
            $mail->addBCC('jvalenzuela@peg.cl', 'Juan Valenzuela');
            $mail->addBCC('mcofre@peg.cl', 'Marcelo Cofré');
            if ($mail->Send()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function correoRechazar($nombreTarea, $descripcionRechazo, $usuarioNombre, $correo, $correoSession, $nombreSession) {

        $html = file_get_contents(ROOT . 'views' . DS . 'sistema' . DS . 'correos' . DS . 'tareaRechazo.html');

        $reempl = array('Titulo' => $nombreTarea,
            'NombreApellidoUser' => $usuarioNombre,
            'DescripcionRechazo' => $descripcionRechazo,
            'Tipo' => 'Rechazo de tarea'
        );

        foreach ($reempl as $nombre => $valor) {
            $html = str_replace('{' . $nombre . '}', $valor, $html);
        }

        if (!empty($nombreTarea)) {
            //--------------------------Configuracion Correo---------------------  
            $this->getLibrary('PHPMailerAutoload');
            $mail = new PHPMailer();
            $mail->IsMAIL();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "mail.peg.cl";
            $mail->Port = 25;
            $mail->Username = "jreyes@peg.cl";
            $mail->Password = "123DnD123!";
            $mail->SMTPDebug = 1;

            $mail->From = 'contacto@peg.cl';
            $mail->FromName = 'Workzilla, Sistema gestor de tareas';
            $mail->CharSet = CHARSET;
            $mail->Subject = 'Rechazo de tarea: ';
            $mail->Body = "";

            $mail->MsgHTML($html);

            $mail->addBCC($correo, $usuarioNombre);
            //                $mail->addBCC($correoSession, $nombreSession);
            $mail->addBCC('mvalenzuela@peg.cl', 'Marco Valenzuela');
            $mail->addBCC('jreyes@peg.cl', 'Jaime Reyes');
            $mail->addBCC('atejos@peg.cl', 'Alberto Tejos');
            $mail->addBCC('jvalenzuela@peg.cl', 'Juan Valenzuela');
            $mail->addBCC('mcofre@peg.cl', 'Marcelo Cofré');
            if ($mail->Send()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function correoFinalizar($nombreTarea, $fechaFinalizacion, $correoSession, $nombreSession, $id_tarea) {
        $html = file_get_contents(ROOT . 'views' . DS . 'sistema' . DS . 'correos' . DS . 'tareaFinalizada.html');
        $reempl = array('Titulo' => $nombreTarea,
            'Tipo' => 'Finalizaci&oacute;n de tarea',
            'Id' => $id_tarea
        );



        foreach ($reempl as $nombre => $valor) {
            $html = str_replace('{' . $nombre . '}', $valor, $html);
        }

        if (empty($nombreTarea)) {

            //--------------------------Configuracion Correo---------------------  
            $this->getLibrary('PHPMailerAutoload');
            $mail = new PHPMailer();
            $mail->IsMAIL();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "mail.peg.cl";
            $mail->Port = 25;
            $mail->Username = "jreyes@peg.cl";
            $mail->Password = "123DnD123!";
            $mail->SMTPDebug = 1;

            $mail->From = 'contacto@peg.cl';
            $mail->FromName = 'Workzilla, Sistema gestor de tareas';
            $mail->CharSet = CHARSET;
            $mail->Subject = 'Finalización de trabajo ';
            $mail->Body = "";

            $mail->MsgHTML($html);

            $mail->addBCC($correoSession, $nombreSession);
            $mail->addBCC('jreyes@peg.cl', 'Jaime Reyes');
            $mail->addBCC('mvalenzuela@peg.cl', 'Marco Valenzuela');
            $mail->addBCC('atejos@peg.cl', 'Alberto Tejos');
            $mail->addBCC('jvalenzuela@peg.cl', 'Juan Valenzuela');
            $mail->addBCC('mcofre@peg.cl', 'Marcelo Cofré');
            if ($mail->Send()) {
                return true;
            } else {

                return false;
            }
        } else {

            return false;
        }
    }

    private function validaSolicitud($descripcionProblema, $solucionPropuesta, $proyecto, $evento, $trabajo, $nivel, $servicio, $area) {
//        if ($proyecto == 0 || $proyecto == null) {
//            return false;
//        }
//        if ($evento == 0 || $evento == null) {
//            return false;
//        }

        if ($descripcionProblema == "" || $descripcionProblema == null) {
            return false;
        }
        if ($solucionPropuesta == "" || $solucionPropuesta == null) {
            return false;
        }
//        if ($trabajo == 0 || $trabajo == null) {
//            return false;
//        }
//        if ($nivel == 0 || $nivel == null) {
//            return false;
//        }
        if ($servicio == 0 || $servicio == null) {
            return false;
        }
//        if ($area == 0 || $area == null) {
//            return false;
//        }


        return true;
    }

    public function insertSolicitud() {
        try {

            //Verificamos si efectivamente seleccionó un archivo
            if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] == UPLOAD_ERR_NO_FILE) {
                if ($this->ingresarSolicitud() == TRUE) {
                    echo "OK";
                }
            } else {

                if ($this->ingresarSolicitud() == TRUE) {
                    $valid_extensions = array('xls', 'xlsx', 'xlsm', 'xlsb', 'xltx', 'xltm', 'xlt', 'xml', 'xlw', 'xla', 'xlam',
                        'doc', 'docx', 'dotx', 'dot', 'txt', 'pdf');

                    $path = ROOT . 'subidas\\';


                    $img = $_FILES['archivo']['name'];
                    $tmp = $_FILES['archivo']['tmp_name'];

                    // obtenemos la extensión
                    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

                    //campos para verificar que estamos asociando el documento a la tarea indicada
                    $descripcionProblema = $this->getTexto("txtDescripcion");
                    $solucionPropuesta = $this->getTexto("txtSolucion");

                    //traemos el id de la tarea ingresada anteriormente
                    $tarea = $this->_tarea->getTarea(null, $descripcionProblema, $solucionPropuesta);
                    $id = $tarea[0]->getIdTarea();

                    // id de la solicitud + el nombre del archivo subido
                    $final_image = $id . " - " . $img;

                    // verificamos el formato correcto
                    if (in_array($ext, $valid_extensions)) {
                        $path = $path . strtolower($final_image);

                        if (move_uploaded_file($tmp, $path)) {
                            //ha sido movido correctamente al servidor                                                    
                            if ($this->_archivo->ingresar($id, $path)) {
                                echo "OK";
                            }
                        }
                    } else {
                        echo 'Archivo inválido, sólo es permitido formato Excel y Word';
                    }
                }
            }
        } catch (mysqli_sql_exception $ex) {
            echo $ex;
        }
    }

    public function ingresarSolicitud() {


        $fechaReporte = date('d/m/Y');
        $horaReporte = date('H:i:s');
        $descripcionProblema = $this->getTexto("txtDescripcion");
        $solucionPropuesta = $this->getTexto("txtSolucion");
        $proyecto = $this->getTexto("selectProyecto");
        $evento = $this->getTexto("selectEvento");
        $trabajo = $this->getTexto("selectTrabajo");
        $nivel = $this->getTexto("selectNivel");
        $servicio = $this->getTexto("selectServicio");
        $area = $this->getTexto("selectArea");

        $horas = 0;
        $ultTareaDao = $this->_tarea->getUltTarea();
        if ($ultTareaDao) {
            $ultimoId = $ultTareaDao[0]->getIdTarea();
        }

        //$ultimoId = mysql_insert_id();
        //Oportunidad de mejora, por temas de no hacer llamadas a la base de datos en temas de traer el detalle del nombre de la prioridad y de la mejora
        //solo se van hacer validaciones directas en el codigo JRR 09/03/2016
//        $nombrePrioridad = '';
//        $nombreTipologia = '';
//        if ($prioridad == '1') {
//            $nombrePrioridad = 'Urgente';
//        }
//        if ($prioridad == '2') {
//            $nombrePrioridad = 'Alta';
//        }
//        if ($prioridad == '3') {
//            $nombrePrioridad = 'Normal';
//        }
//        if ($tipologia == '1') {
//            $nombreTipologia = 'Falla';
//        }
//        if ($tipologia == '2') {
//            $nombreTipologia = 'Incidencia';
//        }
//        if ($tipologia == '3') {
//            $nombreTipologia = 'Mejora';
//        }
//
//        //Matriz de prioridad y de tipología para establecer las horas correspondientes
//
//        if ($prioridad == '1' && $tipologia == '1') {
//            $horas = 3.5;
//        }
//        if ($prioridad == '1' && $tipologia == '2') {
//            $horas = 8;
//        }
//        if ($prioridad == '1' && $tipologia == '3') {
//            $horas = 0;
//        }
//        if ($prioridad == '2' && $tipologia == '1') {
//            $horas = 1.5;
//        }
//        if ($prioridad == '2' && $tipologia == '2') {
//            $horas = 12;
//        }
//        if ($prioridad == '2' && $tipologia == '3') {
//            $horas = 0;
//        }
//        if ($prioridad == '3' && $tipologia == '1') {
//            $horas = 8;
//        }
//        if ($prioridad == '3' && $tipologia == '2') {
//            $horas = 24;
//        }
//        if ($prioridad == '3' && $tipologia == '3') {
//            $horas = 0;
//        }
        //echo $tipologia.'<-Tipologia Prioridad->'.$prioridad.' Horas='.$horas;

        if (!$this->validaSolicitud($descripcionProblema, $solucionPropuesta, $proyecto, $evento, $trabajo, $nivel, $servicio, $area)) {
            echo "Debe ingresar/seleccionar los campos requeridos";
            return false;
        } else {

            $sql = "INSERT INTO tarea(`descripcionProblema`,`solucionPropuesta`,`estado_idEstado`,`servicio_idServicio`,`fechaReporte`,`idUsuarioAsigna`)
                VALUES('" . $descripcionProblema . "', '" . $solucionPropuesta . "', 1 , " . $servicio . ", current_timestamp() , " . Session::get('SESS_ID_USER') . ")";


            $consulta = $this->_tarea->exeSQL($sql);
            if ($consulta) {

                return true;
//                if ($this->correo($nombreTicket, $descripcionProblema, $fechaReporte, $horaReporte, 'Solicitud de tarea', Session::get('SESS_NOMBRE'), Session::get('SESS_CORREO'), $nombrePrioridad, $nombreTipologia, $ultimoId)
//                ) {
//                    echo "OK";
//                } else {
//                    echo "No se pudo enviar el correo";
//                }
            } else {
                echo 'No se pudo insertar la tarea';
                return false;
            }
        }
    }

    public function modificaHito() {
        $id = $this->getTexto('Mm_id_hito');
//        $vigencia = $this->getTexto('Mm_vigencia');
        $nombre = $this->getTexto('Mm_nombre_hito');
        if ($this->validaModificaHito($nombre) == false) {
            
        } else {
            $sql = "UPDATE trabajo set tipificacion ='" . $nombre . "' where idTrabajo = " . $id . "";


            if ($this->_modulo->exeSQL($sql)) {
                echo "OK";
            } else {

                throw new Exception("Ha ocurrido un error, favor de cominicarse con el administrador del sistema");
            }
        }
    }

    public function validaModificaHito($nombre) {

        if (!$nombre) {
            echo "El nombre no puede estar vacío";
            return false;
        }

        return true;
    }

    public function rechazarTarea() {
        $decripcionMotivo = $this->getTexto('it_descripcion_tarea_rechazo');
        $id_tarea = $this->getTexto("it_id_tarea_rechazado");
        $tarea = $this->getTexto("it_nombre_tarea_rechazado");

        $usuario = $this->_usuario->getUsuarioTareaRech($id_tarea);
        // echo var_dump($usuario);
        $nombreUsuario = $usuario[0]->getNombre() . " " . $usuario[0]->getApellido();
        $email = $usuario[0]->getEmail();

        $estado = 5;
        $idTarea = $this->getTexto('it_id_tarea_rechazo');
        $sql = "update tarea set motivoRechazo = '" . $decripcionMotivo . "' , Estado_idEstado = " . $estado . " where idTarea = " . $idTarea . "";
        if ($this->_modulo->exeSQL($sql)) {
            //if($this->correoRechazar($tarea, $decripcionMotivo, $nombreUsuario, $email, Session::get("SESS_CORREO"), Session::get("SESS_NOMBRE"))){
            echo 'OK';
            //}
            //else{
            // echo 'No se pudo enviar el correo'; 
            // }  
        } else {
            echo 'No se ha podido rechazar la tarea, comuníquese con el administrador';
        }
    }

    public function iniciarTarea() {
        //Variables a utilizar
        $fechaInicio = $this->getTexto("fechaIncioInicio");
        $fechaTermino = $this->getTexto("fechaTerminoInicio");
        $id_tarea = $this->getTexto("it_id_tarea_iniciar");
        $descripcionAdmin = $this->getTexto("descripcionAdmin");
        $sql = "UPDATE tarea set fechaInicio = '" . $fechaInicio . "', fechaTermino = '" . $fechaTermino . "', Estado_idEstado = 2 , descripcionAdmin = '" . $descripcionAdmin . "' where idTarea = " . $id_tarea . "";
        $id_tarea1 = $this->getTexto("it_id_tarea_iniciar");
        $id_usuario = $this->getTexto("usuarioAsignacion");
        $fechaAsignacion = $this->getTexto("fechaAsignacion");
        $fechaFinalizacion = $this->getTexto("fechaTermino");

        $tarea = $this->_tarea->getTareaId($id_tarea1);
        $evento = $tarea[0]->getNombre_evento();

        if ($this->getTexto("horaAsignadas") != null) {
            $horasDias = $this->getTexto("horaAsignadas");
        } else {
            $horasDias = 0;
        }
        $nombreTarea = $this->getTexto("it_nombre_tarea");
        $nombreUsuario = "";
        $nombreEvento = $this->getTexto('it_nombre_evento');
        $nombreNivel = $this->getTexto('it_nombre_nivel');
        $fechaReporte = $this->getTexto('it_fecha_reporte'); //$correo = "";
        //Hito
        $hito = $this->getTexto("it_id_hito_iniciar");
        $sql1 = "INSERT INTO tarea_usuario(Tarea_idTarea, Usuario_idUsuario, fechaAsignacion, horasDia, fechaTerminoActividad) VALUES (" . $id_tarea1 . "," . $id_usuario . ", '" . $fechaAsignacion . "'," . $horasDias . ", '" . $fechaFinalizacion . "')";
        $cantidadRegistros = $this->_modulo->cantidadHitosUsuarios($hito, $id_usuario);
        //echo $id_usuario;
        //Usuarios para obtener el nombre, este tiene que ser mostrado en el correo electrónico
        $usuarios1 = $this->_usuario->getUsuarioId($id_usuario);
        //if($usuarios){
        //var_dump($usuarios1);
        $nombreUsuario = $usuarios1[0]->getNombre() . ' ' . $usuarios1[0]->getApellido();
        $correo = $usuarios1[0]->getEmail();

        $id_user_clie = $this->getTexto('it_id_user');
        $usClie = $this->_usuario->getUsuarioId($id_user_clie);

        $nombreUsuarioClie = $usClie[0]->getNombre() . ' ' . $usClie[0]->getApellido();
        $correoClie = $usClie[0]->getEmail();

        //Session::destroy('t_user');


        if (!$this->validacionInicioTarea($fechaInicio, $fechaTermino, $fechaAsignacion, $fechaFinalizacion, $horasDias, $id_usuario, $evento)) {
            
        } else {

            if ($cantidadRegistros) {
                if ($cantidadRegistros[0]->getIdHito() < 1) {
                    $sql3 = "INSERT INTO hito_usuario (Hito_idHito, Usuario_idUsuario) VALUES (" . $hito . "," . $id_usuario . ") ";
                    $this->_modulo->exeSQL($sql3);
                }
            }
            if ($this->_modulo->exeSQL($sql)) {
                if ($this->_modulo->exeSQL($sql1)) {
                    if ($this->correoIniciar($nombreTarea, $id_tarea, $fechaInicio, $fechaTermino, $fechaAsignacion, $fechaFinalizacion, $nombreUsuario, $horasDias, $correo, Session::get('SESS_CORREO'), Session::get('SESS_NOMBRE'), $correoClie, $nombreUsuarioClie, $nombreEvento, $nombreNivel, $fechaReporte, $descripcionAdmin, $horasDias
                            ) == true) {
                        echo "OK";
                        //echo $correo.' '. Session::get('SESS_CORREO');
                    } else {
                        echo "No se pudo enviar el correo electrónico al destinatario";
                    }
                } else {
                    echo 'No se ha podido iniciar la tarea, comuníquese con el administrador';
                }
            } else {
                echo 'No se ha podido iniciar la tarea, comuníquese con el administrador';
            }
        }
    }

    public function validacionInicioTarea($fechaInicio, $fechaTermino, $fechaAsignacion, $fechaFinalizacion, $horasDias, $id_usuario, $evento) {

        $segundos = strtotime($fechaAsignacion);
        $segundos2 = strtotime($fechaFinalizacion);
        $segundosHorasDias = abs($segundos - $segundos2);
        //echo $segundos.' '.$segundos2.' '.abs($segundos-$segundos2);
        if ($id_usuario == null || $id_usuario == "") {
            echo "Debe existir el nombre de usuario";
            return false;
        } else if ($evento != "Mejora" && ($horasDias == null || $horasDias == "" || $horasDias == 0)) {
            echo "Ingrese las horas para asignar el recurso";
            return false;
        } else if ($fechaInicio == null || $fechaInicio == "") {
            echo "Ingrese la fecha de inicio de la tarea";
            return false;
        } else if ($fechaTermino == null || $fechaTermino == "") {
            echo "Ingrese la fecha de término de la tarea";
            return false;
        } else if ($fechaAsignacion == null || $fechaAsignacion == "") {
            echo "Ingrese la fecha de asignaci&oacute;n para el recurso";
            return false;
        } else if ($fechaFinalizacion == null || $fechaFinalizacion == "") {
            echo "Ingrese la fecha de t&eacute;nrmino para el recurso";
            return false;
        } else if ($fechaInicio > $fechaTermino) {
            echo "La fecha de término de la tarea debe ser mayor a la de inicio";
            return false;
        } else if ($fechaAsignacion > $fechaFinalizacion) {
            echo "La fecha término de asignaci&oacute;n del recurso debe ser mayor a la de inicio";
            return false;
        } else if ($evento != "Mejora" && ($segundosHorasDias > $horasDias * 3600)) {
            echo "Sobrepasa la cantidad de horas para la asignaci&oacute;n";
            return false;
        } else if ($segundos < strtotime($fechaInicio)) {
            echo "La fecha de asignación ingresada no puede ser menor a la fecha de la tarea general";
            return false;
        } else
        if ($segundos2 > strtotime($fechaTermino)) {
            echo "La fecha de término de asignación ingresada no puede ser mayor a la fecha de la tarea general";
            return false;
        }

        return true;
    }

    public function asignarTareaUsuario() {
        //Variables a utilizar
        $id_tarea1 = $this->getTexto("it_id_tarea_asignacion");
        $id_usuario = $this->getTexto("usuarioAsignacion");
        $fechaAsignacion2 = $this->getTexto("fechaAsignacion2");
        $fechaFinalizacion2 = $this->getTexto("fechaTermino2");
        $horasDias = $this->getTexto("horaAsignadas");
        if ($horasDias == null) {
            $horasDias = 0;
        }
        $hito = $this->getTexto("it_id_hito_asignacion");


        $tarea = $this->_tarea->getTareaId($id_tarea1);
        $fechaInicio = $tarea[0]->getFechaInicio();
        $fechaTermino = $tarea[0]->getFechaTermino();


        if (!$this->validacionTareaUsuario($fechaInicio, $fechaTermino, $fechaAsignacion2, $fechaFinalizacion2)) {
            
        } else {

            $sql1 = "INSERT INTO tarea_usuario(Tarea_idTarea, Usuario_idUsuario, fechaAsignacion, horasDia, fechaTerminoActividad) VALUES (" . $id_tarea1 . "," . $id_usuario . ", '" . $fechaAsignacion2 . "'," . $horasDias . ", '" . $fechaFinalizacion2 . "')";

            $cantidadRegistros = $this->_modulo->cantidadHitosUsuarios($hito, $id_usuario);

            if ($cantidadRegistros) {
                if ($cantidadRegistros[0]->getIdHito() < 1) {
                    $sql3 = "INSERT INTO hito_usuario (Hito_idHito, Usuario_idUsuario) VALUES (" . $hito . "," . $id_usuario . ") ";
                    $this->_modulo->exeSQL($sql3);
                }
            }
            $cantidadRegistrosUsTarea = $this->_tarea->getCantidadTareaUsuario($id_tarea1, $id_usuario);

            if ($cantidadRegistrosUsTarea[0]->getIdTarea() > 0) {
                echo "Ya existe este usuario para esta tarea, seleccione otro usuario";
            } else {
                if ($this->_modulo->exeSQL($sql1)) {

                    echo "OK";
                } else {
                    echo 'No se ha podido iniciar la tarea, comuníquese con el administrador';
                }
            }

            //Session::set('t_user', 1);
        }
    }

    function validacionTareaUsuario($fechaInicio, $fechaTermino, $fechaAsignacion2, $fechaFinalizacion2) {


        if (strtotime($fechaAsignacion2) < strtotime($fechaInicio)) {
            echo "La fecha de asignación ingresada no puede ser menor a la fecha de la tarea general";
            return false;
        } else
        if (strtotime($fechaFinalizacion2) > strtotime($fechaTermino)) {
            echo "La fecha de término de asignación ingresada no puede ser mayor a la fecha de la tarea general";
            return false;
        }

        return true;
    }

    public function iniciarProceso() {
        $id_tarea = $this->getTexto("it_id_tarea_proceso");
        $id_usuario = Session::get("SESS_ID_USER");
        $sql = "UPDATE tarea_usuario set fechaInicio = current_timestamp() where Tarea_idTarea = " . $id_tarea . " and Usuario_idUsuario = " . $id_usuario . ";";
        $sql2 = "UPDATE tarea set Estado_idEstado = 3 where idTarea = " . $id_tarea . "";
        if ($this->_modulo->exeSQL($sql)) {
            if ($this->_modulo->exeSQL($sql2)) {
                echo "OK";
            } else {
                echo 'No se ha podido dejar en estado en proceso, comuníquese con el administrador';
            }
        } else {
            echo 'No se ha podido dejar en estado en proceso, comuníquese con el administrador';
        }
    }

    public function finalizarProceso() {
        $fechaReporte = date('Y.m.d H:i:s');
        $nombre_tarea = $this->getTexto("it_nombre_tarea_finalizado");
        $id_tarea = $this->getTexto("it_id_tarea_finalizado");
        $id_usuario = Session::get("SESS_ID_USER");
        $nombre_usuario = Session::get("SESS_NOMBRE");
        //$correo = Session::get("SESS_CORREO");  
        $sql2 = "UPDATE tarea set Estado_idEstado = 4 where idTarea = " . $id_tarea . "";
        //echo $sql2;
//        $nombre = "";
//        $correo = "";
//        $usuarioTarea = $this->_usuario->getUsuarioTarea($id_tarea, $id_usuario);
//        if($usuarioTarea){
//        $nombre = $usuarioTarea[0]->getNombre() . " " . $usuarioTarea[0]->getApellido();
//        $correo = $usuarioTarea[0]->getEmail(); 
//        }
//        else{
//          
//        }
        $id_user_finalizado = $this->getTexto('it_id_user_finalizado');
        $usClie = $this->_usuario->getUsuarioId($id_user_finalizado);

        $nombreUsuarioClie = $usClie[0]->getNombre() . ' ' . $usClie[0]->getApellido();
        $correoClie = $usClie[0]->getEmail();




        if ($this->_modulo->exeSQL($sql2)) {
            if ($this->correoFinalizar($nombre_tarea, $fechaReporte, $correoClie, $nombreUsuarioClie, $id_tarea)) {
                //echo $id_user_finalizado.$correoClie;
                //echo $id_tarea;
                echo "OK";
            } else {
                echo "No se pudo enviar el correo";

                //echo $id_tarea." ". $id_usuario; 
            }
        } else {

            echo 'No se ha podido dejar en estado en proceso, comuníquese con el administrador';
        }
    }

    public function abreAsignaUsuarioProducto() {
        $usuario = $this->_usuario->getUsuario("");
        $proyecto = $this->_proyecto->getTodosProyectos();

        $this->_view->proyectos = $proyecto;
        $this->_view->usuarios = $usuario;
        $this->_view->renderizaCenterBox('asignaUsuarioProducto');
    }

    public function insertUsuarioProyecto() {
        $usuario = $this->getTexto('sel_usuario');
        $proyecto = $this->getTexto('sel_proyecto');
        $consultaProyectoUsuario = $this->_proyecto->getProyectoUsuario($proyecto, $usuario);

        if ($consultaProyectoUsuario[0]->getId_producto()) {
            echo "No se puede";
        } else {
            $sql = "INSERT INTO producto_usuario (producto_idProducto, usuario_idUsuario) VALUES (" . $proyecto . ", " . $usuario . ")";
            if ($this->_modulo->exeSQL($sql)) {
                echo "OK";
            } else {
                echo "No se ha podido asignar un proyecto al usuario especificado";
            }
        }
    }

}
