<?php
    include_once '../Bo/CoordenadasBo.php';
    include_once '../Config/Utilidades.php';
    
    //Metodos implementados de acceso
    //entidad                   entidad        metodo      dato                                    Tipo
    //===========================================================================================================
    //coordenadas/all     	    coordenadas    all         -                                       GET 	    JSON
    //coordenadas/ruta/{ruta}   coordenadas    ruta        501101                                  GET 	    JSON
    //coordenadas/fecha     	coordenadas    fecha       {inicio, fin}                           POST     JSON
    //coordenadas/fecharuta 	coordenadas    fecharuta   {inicio, fin, [ruta]}                   POST     JSON
    
    $entidad = "";
    $metodo = "";
    $dato = "";
    $userBo = null;

    //Obtengo URL de la petición
    $metodoServidor = devuelveTipoPeticion();   //   GET | POST | DEL | PUT
    $urlPage = devuelvePaginaSolicitada();      //   /reactmapa/api/usuario.php
    
    [$entidad, $metodo, $dato] = devuelveDatoUrl($urlPage);

    if(!empty($entidad) && !empty($metodo)){
        $coordenadasBo = new CoordenadasBo();
        switch($metodoServidor)
        {
            case "get": 
                $datos = $coordenadasBo->consultaBo($entidad, $metodo, $dato, $metodoServidor);
                break;
            case "post": 
                $json = file_get_contents('php://input'); // takes raw data from the request 
                $dato = json_decode($json, true); // Converts it into a PHP object 
                $datos = $coordenadasBo->consultaBo($entidad, $metodo, $dato, $metodoServidor);
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
