<?php
include_once '../Bo/UsuarioBo.php';
include_once '../API/Utilidades.php';
echo "entro";
//pongo en el navegador
//entidad                       entidad             metodo              dato                Tipo
//=================================================================================================
//usuarios/all     	            usuarios            all                 -                   GET 	JSON
//usuarios/id/{id}       	    usuarios            id                  500857              GET 	JSON
//usuarios/correo/{correo}   	usuarios            correo              jmiranda@cbc.co     GET 	JSON
//usuarios/validate     	    usuarios            validate            {}                  POST 	JSON
//usuarios/post 	            usuarios            post                {}                  POST 	JSON
//usuarios/put/{id} 	        usuarios            put                 500857   {}         PUT 	JSON
//usuarios/del/{id}             usuarios            del                 500857           	DELETE 	JSON

$entidad = "";
$metodo = "";
$dato = "";
$userBo = null;

//Obtengo URL de la petición

$metodoServidor = strtolower($_SERVER['REQUEST_METHOD']);   //   GET | POST | DEL | PUT
$urlServidor = strtolower($_SERVER['HTTP_HOST']);           //   localhost:8888
$urlPage = strtolower($_SERVER['REQUEST_URI']);             //   /reactmapa/api/usuario.php
$urlPageArray = explode("/", $urlPage);                     //   Array
//echo ">>Cantidad es:" . count($urlPageArray);             //   Cantidad del Array   (4)


//echo $urlPageArray[1]; //directorio principal     // reactmapa 
//echo $urlPageArray[2]; //directorio llamada API   // api
if(count($urlPageArray)>4) //Existe Entidad        || usuario
    $entidad = $urlPageArray[3];
if(count($urlPageArray)>4) //Existe metodo         || getUsuarioId
    $metodo = $urlPageArray[4];
if(count($urlPageArray)>5) //Existe dato           || 500857
    $dato = $urlPageArray[5];

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
        default:
            $codigoHttp = 404;
            http_response_code($codigoHttp);
            echo json_encode(
                array(  
                    "Clase" => "", 
                    "Cantidad" => 0,
                    "mensaje" => "Metodo no implementado.",
                    "codigoHttp" => $codigoHttp,
                    "mensajeHttp" => codigoErrorHttp($codigoHttp),
                    "registros" => []
                )
            );
            break;
    }
}else{
    $codigoHttp = 404;
    http_response_code($codigoHttp);
    echo json_encode(
        array(  
            "Clase" => "", 
            "Cantidad" => 0,
            "mensaje" => "Se esperan parametros.",
            "codigoHttp" => $codigoHttp,
            "mensajeHttp" => codigoErrorHttp($codigoHttp),
            "registros" => []
        )
    );
}

?> 
