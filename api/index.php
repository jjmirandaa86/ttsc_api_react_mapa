<?php

    $metodoServidor = strtolower($_SERVER['REQUEST_METHOD']);   //   GET | POST | DEL | PUT
    echo "Metodo Servidor: " . $metodoServidor . "\n";
    
    $urlServidor = strtolower($_SERVER['HTTP_HOST']);           //   localhost:8888
    echo "URL Servidor: " . $urlServidor . "\n";
    
    $urlPage = strtolower($_SERVER['REQUEST_URI']);             //   /reactmapa/api/usuario.php
    echo "URL: " . $urlPage . "\n";
    
    $urlPageArray = explode("/", $urlPage);                     //   Array

    if($urlPageArray[3] !== "") 
        $entidad = $urlPageArray[3];
    if($urlPageArray[4] !== "") 
        $metodo = $urlPageArray[4];
    if($urlPageArray[5] !== "") 
        $dato = $urlPageArray[5];


    echo "Entidad: " . $entidad . "\n";
    echo "Metodo: " . $metodo . "\n";
    echo "Dato: " . $dato . "\n";
    
    header('Location: Usuario.php');

    /*
//Desvio a la entidad que corresponda.
    
    
    
    
    if(count($urlPageArray)>4) //Existe metodo         || getUsuarioId
        $metodo = $urlPageArray[4];
    if(count($urlPageArray)>5) //Existe dato           || 500857
        $dato = $urlPageArray[5];

        switch($entidad)
        {
            case "usuarios": //Recupera todos los usuarios
                //header('Location: '.$nuevaURL.php);
                echo "enviaste usuarios/all/get"
                break;

            default:
                echo "no enviaste nada"
                break;
        }
*/
?>

