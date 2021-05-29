<?php
    include_once '../Bo/UsuarioBo.php';
    include_once '../Config/Utilidades.php';
    
    //Metodos implementados de acceso
    //entidad                   entidad     metodo      dato                                                        Tipo
    //=============================================================================================================================
    //usuarios/all     	        usuarios    all         -                                                           GET 	JSON
    //usuarios/id/{id}       	usuarios    id          500857                                                      GET 	JSON
    //usuarios/correo/{correo}  usuarios    correo      jmiranda@cbc.co                                             GET 	JSON
    //usuarios/validate     	usuarios    validate    {correo, clave}                                             POST 	JSON
    //usuarios/crea 	        usuarios    post        {idUsuario, nombre, apellido, correo, contrasena, estado}   POST    JSON
    //usuarios/modifica 	    usuarios    put         {idUsuario, nombre, apellido, correo, contrasena, estado}   PUT 	JSON
    //usuarios/del/{id}         usuarios    del         500857           	                                        DELETE 	JSON

    $entidad = "";
    $metodo = "";
    $dato = "";
    $userBo = null;

    //Obtengo URL de la petición
    $metodoServidor = devuelveTipoPeticion();   //   GET | POST | DEL | PUT
    $urlPage = devuelvePaginaSolicitada();      //   /reactmapa/api/usuario.php
    
    [$entidad, $metodo, $dato] = devuelveDatoUrl($urlPage);

    if(!empty($entidad) && !empty($metodo)){
        $userBo = new UsuarioBo();
        switch($metodoServidor)
        {
            case "get": 
                $datos = $userBo->consultaBo($entidad, $metodo, $dato, $metodoServidor);
                break;
            case "post": 
                $json = file_get_contents('php://input'); // takes raw data from the request 
                $dato = json_decode($json, true); // Converts it into a PHP object 
                $datos = $userBo->consultaBo($entidad, $metodo, $dato, $metodoServidor);
                break;
            case "put": 
                $json = file_get_contents('php://input'); // takes raw data from the request 
                $dato = json_decode($json, true); // Converts it into a PHP object 
                $datos = $userBo->consultaBo($entidad, $metodo, $dato, $metodoServidor);
                break;
            default:
                echo json_encode( seteaMensaje(
                    "Error, no existe el metodo buscado",
                    0,
                    "Metodo no implementado.",
                    404,
                    []
                ));
                break;
        }
    }else{
        echo json_encode( seteaMensaje(
            "Error, se esperan parametros",
            0,
            "Se esperan parametros.",
            404,
            [] 
        ));
    }

?> 
