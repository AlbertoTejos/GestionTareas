<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_name('GestionTareas');//
session_cache_limiter('nocache');
define('DS',DIRECTORY_SEPARATOR);// Va diferir dependiendo del sistema operativo
define('ROOT',  realpath(dirname(__FILE__)).DS);//inclución de archivos que estan dentro del servidor
define('APP_PATH', ROOT . 'application' . DS);
define('CHARSET', 'utf-8');
header('Content-Type: text/html; charset='.CHARSET);
try{
require_once APP_PATH . 'Config.php';
require_once APP_PATH . 'Request.php';
require_once APP_PATH . 'Controller.php';
//require_once APP_PATH . 'Registro.php';
require_once APP_PATH . 'Bootstrap.php';
require_once APP_PATH . 'Model.php';
require_once APP_PATH . 'View.php';
require_once APP_PATH . 'Session.php';
require_once APP_PATH . 'Database.php';
//require_once APP_PATH . 'Functions.php';

/*$r = new Request();

echo $r->getControlador() . '<br>';
echo $r->getMetodo() . '<br>';
print_r($r->getArgs());*/

 Session::init();
Bootstrap::run(new Request);

}
catch(Exception $e){
    
    echo $e->getMessage();

}
