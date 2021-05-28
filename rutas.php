<?php 
    
    $host = $_SERVER['HTTP_HOST'];
    $protocol = $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';
    $urlPageArray = explode("/", $_SERVER['REQUEST_URI']);
    
    $UrlAccedida = $protocol . "://" .  $host . $_SERVER['REQUEST_URI'];
    $UrlPrincipal = $protocol . "://" .  $host . "/" .  $urlPageArray[1];
    
    define("ROOT_PATH", $UrlPrincipal.'/');
    define("ROOT_PATH_API", $UrlPrincipal.'/api');
    define("ROOT_PATH_BO", $UrlPrincipal.'/Bo');
    define("ROOT_PATH_CLASS", $UrlPrincipal.'/Class');
    define("ROOT_PATH_CONFIG", $UrlPrincipal.'/Config');
    define("ROOT_PATH_DAO", $UrlPrincipal.'/Dao');
    
    echo ROOT_PATH_CLASS;
    
    //echo $UrlAccedida;
/*    
    
    $urlServidor = strtolower($_SERVER['HTTP_HOST']);           //   localhost:8888
    $urlPage = strtolower($_SERVER['REQUEST_URI']);             //   /reactmapa/api/usuario.php

    */
    //define('CONTROLLER_PATH', ROOT_PATH.'controller/');
    //define('MODEL_PATH', ROOT_PATH.'model/');
    //define('DAO_PATH', ROOT_PATH.'dao/');
    //define('IMP_PATH', DAO_PATH.'imp/');


    //include_once ($_SERVER['DOCUMENT_ROOT'].'/dirs.php');
    //include (DAO_PATH."PersonaDao.php");
    
    
?>


