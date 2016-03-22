<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gestion Tareas</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $_layoutParams["ruta_template"] ?>images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo $_layoutParams["ruta_template"] ?>images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $_layoutParams["ruta_template"] ?>images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href=<?php echo $_layoutParams["ruta_template"] ?>"images/icons/favicon-114x114.png">
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poiret+One">
    <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams["ruta_template"] ?>styles/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams["ruta_template"] ?>styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams["ruta_template"] ?>styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams["ruta_template"] ?>styles/animate.css">
    <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams["ruta_template"] ?>styles/all.css">
    <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams["ruta_template"] ?>styles/main.css">
    <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams["ruta_template"] ?>styles/style-responsive.css">
    <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams["ruta_template"] ?>styles/zabuto_calendar.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams["ruta_template"] ?>styles/pace.css">
    <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams["ruta_template"] ?>styles/jquery.news-ticker.css">
    <link type="text/css" rel="stylesheet" href="<?php echo $_layoutParams["ruta_template"] ?>datetimepicker-master/jquery.datetimepicker.css">
    <link href="<?php echo $_layoutParams['ruta_css']; ?>jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $_layoutParams['ruta_css']; ?>jquery-ui.structure.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $_layoutParams['ruta_css']; ?>jquery-ui.theme.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $_layoutParams['ruta_css']; ?>jquery.pnotify.default.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div>
         <div class="ui-pnotify " id="divAlertExito" style="width: 300px; right: 25px; top: 25px; opacity: 1; display: none; cursor: auto;">
            <div class="alert ui-pnotify-container alert-success ui-pnotify-shadow" style="min-height: 16px;">
                <h4 class="ui-pnotify-title">Terminado</h4>

                <div class="ui-pnotify-text" id="mensajeOk"><span id="msjOk"></span></div>
            </div>
        </div>

        <div class="ui-pnotify " id="divAlertWar" style="width: 300px; right: 25px; top: 25px; opacity: 1; display: none; cursor: auto;">
            <div class="alert ui-pnotify-container alert-danger ui-pnotify-shadow" style="min-height: 16px;">
                <h4 class="ui-pnotify-title">&iexcl;Atenci&oacute;n!</h4>
                <div class="ui-pnotify-text" id="mensajeWar"><span id="msjWar"></span></div>
            </div><!--<img src="<?php echo $_layoutParams['ruta_img']; ?>st_rojo.png" width="16" border="0"  />-->
        </div>
        <div class="ui-pnotify " id="divAlertInfo" style="width: 300px; right: 25px; top: 25px; opacity: 1; display: none; cursor: auto;">
            <div class="alert ui-pnotify-container alert-info ui-pnotify-shadow" style="min-height: 16px;">
                <h4 class="ui-pnotify-title">Cargando <img src="<?php echo $_layoutParams['ruta_img']; ?>loading.gif" width="30" border="0"  /></h4>
                <div class="ui-pnotify-text" id="mensajeWar"><span id="msjInfo"></span></div>
            </div>
        </div>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="modal_dialog" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #07a; color: #fff">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ML_tituloForm"></h4>
            </div>

            <div class="modal-body" id="ML_divPopup"></div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="modalConfirmacion">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titulo"></h4>
      </div>
      <div class="modal-body">
        <p id="texto"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger">Confirmar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
        <!--BEGIN THEME SETTING-->
        
        <!--END THEME SETTING-->
        <!--BEGIN BACK TO TOP-->
        <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
        <!--END BACK TO TOP-->
        <!--BEGIN TOPBAR-->
        <div id="header-topbar-option-demo" class="page-header-topbar">
            <nav id="topbar" role="navigation" style="margin-bottom: auto;" data-step="3" class="navbar navbar-default navbar-static-top">
            <div class="navbar-header" style="background-color: white;">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <span><img width="200px" style="margin-top: 5px;" src="<?php echo $_layoutParams["ruta_img"] ?>logo-workzilla-peg.jpg"></span><span style="display: none" class="logo-text-icon"></span></div>
            <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
                <div style="float: left; margin-top: 5px; margin-left: 2%;"><h4 style="color: white; font-family: 'Poiret One', cursive;">Sistema Gestor de Tareas</h4></div>
<!--                <form id="topbar-search" action="" method="" class="hidden-sm hidden-xs">
                    <div class="input-icon right text-white"><a href="#"><i class="fa fa-search"></i></a><input type="text" placeholder="Search here..." class="form-control text-white"/></div>
                </form>-->
<!--                <div class="news-update-box hidden-xs"><span class="text-uppercase mrm pull-left text-white">News:</span>
                    <ul id="news-update" class="ticker list-unstyled">
                        <li>Welcome to KAdmin - Responsive Multi-Style Admin Template</li>
                        <li>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque.</li>
                    </ul>
                </div>-->
                <ul class="nav navbar navbar-top-links navbar-right mbn">
<!--                    <li class="dropdown"><a data-hover="dropdown" href="#" class="dropdown-toggle"><i class="fa fa-bell fa-fw"></i><span class="badge badge-green">3</span></a>
                        
                    </li>
                    <li class="dropdown"><a data-hover="dropdown" href="#" class="dropdown-toggle"><i class="fa fa-envelope fa-fw"></i><span class="badge badge-orange">7</span></a>
                        
                    </li>
                    <li class="dropdown"><a data-hover="dropdown" href="#" class="dropdown-toggle"><i class="fa fa-tasks fa-fw"></i><span class="badge badge-yellow">8</span></a>
                        
                    </li>-->
                    <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><!--<img src="images/avatar/48.jpg" alt="" class="img-responsive img-circle"/>-->&nbsp;<span class="hidden-xs"><?php echo Session::get("SESS_USER"); ?></span>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right">
<!--                            <li><a href="datoslogin"><i class="fa fa-user"></i>Mi Perfil</a></li>-->
<!--                            <li><a href="#"><i class="fa fa-calendar"></i>My Calendar</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i>My Inbox<span class="badge badge-danger">3</span></a></li>
                            <li><a href="#"><i class="fa fa-tasks"></i>My Tasks<span class="badge badge-success">7</span></a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="fa fa-lock"></i>Lock Screen</a></li>-->
                            <li><a href="<?php echo BASE_URL ?>index"><i class="fa fa-key"></i>Salir</a></li>
                        </ul>
                    </li>
<!--                    <li id="topbar-chat" class="hidden-xs"><a href="javascript:void(0)" data-step="4" data-intro="&lt;b&gt;Form chat&lt;/b&gt; keep you connecting with other coworker" data-position="left" class="btn-chat"><i class="fa fa-comments"></i><span class="badge badge-info">3</span></a></li>-->
                </ul>
            </div>
        </nav>
            <!--BEGIN MODAL CONFIG PORTLET-->
<!--            <div id="modal-config" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                                &times;</button>
                            <h4 class="modal-title">
                                Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eleifend et nisl eget
                                porta. Curabitur elementum sem molestie nisl varius, eget tempus odio molestie.
                                Nunc vehicula sem arcu, eu pulvinar neque cursus ac. Aliquam ultricies lobortis
                                magna et aliquam. Vestibulum egestas eu urna sed ultricies. Nullam pulvinar dolor
                                vitae quam dictum condimentum. Integer a sodales elit, eu pulvinar leo. Nunc nec
                                aliquam nisi, a mollis neque. Ut vel felis quis tellus hendrerit placerat. Vivamus
                                vel nisl non magna feugiat dignissim sed ut nibh. Nulla elementum, est a pretium
                                hendrerit, arcu risus luctus augue, mattis aliquet orci ligula eget massa. Sed ut
                                ultricies felis.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">
                                Close</button>
                            <button type="button" class="btn btn-primary">
                                Save changes</button>
                        </div>
                    </div>
                </div>
            </div>-->
            <!--END MODAL CONFIG PORTLET-->
        </div>
        <!--END TOPBAR-->
        
         <div id="wrapper">
                <!--BEGIN SIDEBAR MENU-->
            <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"
                data-position="right" class="navbar-default navbar-static-side" style="z-index: 100">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                    
                     <div class="clearfix"></div>
                    <?php if(Session::get('SESS_ID_TIPO_USER') == 0 || Session::get('SESS_ID_TIPO_USER') == 1 ){?>
                    

                      <li><a data-toggle="modal" href="#myModal"  onClick="Modulo.prototype.abreModal('<?php echo BASE_URL ?>modulo/abreSolicitudTareas','Crear nueva solicitud de tarea', '')"><i class="fa fa-plus fa-fw">
                        <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Crear nueva solicitud de tarea</span></a>
                       
                    </li>
  
                    <li><a href="<?php echo BASE_URL?>sistema"><i class="fa fa-bullseye fa-fw">
                        <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Monitor de Tareas</span></a>
                       
                    </li>
                    <li><a href="<?php echo BASE_URL?>informe"><i class="fa fa-clock-o fa-fw">
                        <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Horas realizadas</span></a>
                       
                    </li>

                    <li><a href="<?php echo BASE_URL?>cliente"><i class="fa fa-users fa-fw">
                        <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Administraci&oacute;n de Clientes</span></a>
                       
                    </li>

                    <li><a href="<?php echo BASE_URL?>proyecto"><i class="fa fa-list fa-fw">
                        <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Administraci&oacute;n de Proyectos</span></a>
                       
                    </li>
                    <li><a href="<?php echo BASE_URL?>modulo/abreAdmModulo"><i class="fa fa-calendar fa-fw">
                        <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Administraci&oacute;n de Trabajos</span></a>
                       
                    </li>
                    <li><a href="<?php echo BASE_URL?>evento"><i class="">
                        <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Administraci&oacute;n de Eventos</span></a>
                       
                    </li>
                    <li><a href="<?php echo BASE_URL?>area"><i class="">
                        <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Administraci&oacute;n de Áreas</span></a>
                       
                    </li>
                    <li><a href="<?php echo BASE_URL?>servicio"><i class="">
                        <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Administraci&oacute;n de Servicios</span></a>
                       
                    </li>
                    <li><a href="<?php echo BASE_URL?>nivel"><i class="">
                        <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Administraci&oacute;n de Niveles de Criticidad</span></a>
                       
                    </li>
                    <li><a href="<?php echo BASE_URL?>usuario"><i class="fa fa-user fa-fw">
                        <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Administraci&oacute;n de Usuarios</span></a>
                       
                    </li>
                    
                    
                      <li><a data-toggle="modal" href="#myModal"  onClick="Modulo.prototype.abreModal('<?php echo BASE_URL ?>modulo/abreAsignaUsuarioProducto',' Asignar Usuario a Proyecto', '')"><i class="fa fa-plus fa-fw">
                        <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Asignar Usuario a proyecto</span></a>
                       
                    </li>
                    <li><a href="<?php echo BASE_URL?>avance"><i class="fa fa-bullseye fa-fw">
                        <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Monitor de Avances</span></a>
                       
                    </li>
                    
                    
                    
                    
                    <?php 
                    }
                    ?>
                    
                     <?php if(Session::get('SESS_ID_TIPO_USER')== 2){ ?>
                    <li><a data-toggle="modal" href="#myModal"  onClick="Modulo.prototype.abreModal('<?php echo BASE_URL ?>modulo/abreSolicitudTareas','Crear nueva solicitud de tarea', '')"><i class="fa fa-plus fa-fw">
                        <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Crear nueva solicitud de tarea</span></a>
                       
                    </li>
                  
                    <?php } ?>
                    <?php if(Session::get('SESS_ID_TIPO_USER')== 3){ ?>
                    <li><a data-toggle="modal" href="#myModal"  onClick="Modulo.prototype.abreModal('<?php echo BASE_URL ?>modulo/abreSolicitudTareas','Crear nueva solicitud de tarea', '')"><i class="fa fa-plus fa-fw">
                        <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Crear nueva solicitud de tarea</span></a>
                       
                    </li>
                    <li><a href="<?php echo BASE_URL?>avance"><i class="fa fa-bullseye fa-fw">
                        <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Monitor de Avances</span></a>
                       
                    </li>
                    <li><a href="<?php echo BASE_URL?>informe"><i class="fa fa-clock-o fa-fw">
                        <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Horas realizadas</span></a>
                       
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
         </div>
                  <div id="page-wrapper">
            <!--END SIDEBAR MENU-->