<?php

    $host = $_SERVER['HTTP_HOST'];
    $protocol = $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';
    $urlPageArray = explode("/", $_SERVER['REQUEST_URI']);
    
    $UrlAccedida = $protocol . "://" .  $host . $_SERVER['REQUEST_URI'];
    $UrlPrincipal = $protocol . "://" .  $host . "/" .  $urlPageArray[1];

    echo $UrlPrincipal . "/rutas.php";

    include_once ($UrlPrincipal . "/rutas.php");
    
    echo "\nROOT_PATH_CLASS: ";

    echo ROOT_PATH_CLASS;

    //include (ROOT_PATH_CONFIG."PersonaDao.php");
    

?> 
