<?php
    echo ">>>>>>>>>>>> hola desde DAO ========= \n";
    #include_once '/../Config/database.php';
    #include_once '/../Class/Usuario.php';
    #include_once '/../api/Utilidades.php';
    #include_once '/../Config/Contrasena.php';

    echo ">>>>>>>>>>>> cierre desde DAO ========= \n";

    header("Access-Control-Allow-Origin: *"); //Solo select
    header("Content-Type: application/json; charset=UTF-8"); //Solo select
    header("Access-Control-Allow-Methods: POST"); //Solo select
    header("Access-Control-Max-Age: 3600"); //todos los 5 en update, crear 
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); //todos los 5 en update, , crear

    class UsuarioDao{
        private $database = null; //Class
        private $usuario = null; //Class
        private $classContrasena = null; //Class
        private $conn = null; //Objeto conexion

        function __construct() {
            $this->database = new Database();
            $this->usuario = new Usuario();
            $this->conn = $this->database->getConnection();
            $this->classContrasena = new Contrasena();
            
        }

        public function __destruct()
        {
            $this->conn = $this->database->closeConnection();
            $this->usuario = null;
        }

        //****************************+ */
        // Obtiene todos los Usuarios
        //****************************+ */
        function getAllUsuarios(){
            $query = "SELECT * FROM " . $this->usuario->getDbTable();
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            if($num>0)
            {
                $datosArray=array();
                $datosArray["datos"]=array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    extract($row);
                    $dateItem=array(
                        "idUsuario" => $idUsuario,
                        "nombre" => $nombre,
                        "apellido" => $apellido,
                        "correo" => $correo,
                        "estado" => $estado
                    );
                    array_push($datosArray["datos"], $dateItem);
                }
                
                $codigoHttp = 200;
                http_response_code($codigoHttp);
                echo json_encode(
                    array(  "Clase" => $this->usuario->getDbTable(), 
                            "Cantidad" => $num,
                            "mensaje" => "Registros Encontrados.",
                            "codigoHttp" => $codigoHttp,
                            "mensajeHttp" => codigoErrorHttp($codigoHttp),
                            "registros" => $datosArray
                        )
                );
                
            }else{
                $codigoHttp = 404;
                http_response_code($codigoHttp);
                echo json_encode(
                    array(  "Clase" => $this->usuario->getDbTable(), 
                            "Cantidad" => $num,
                            "mensaje" => "No se encontraron registros.",
                            "codigoHttp" => $codigoHttp,
                            "mensajeHttp" => codigoErrorHttp($codigoHttp),
                            "registros" => []
                        )
                );
            }
        }

        //****************************+ */
        // Obtiene el Usuario por id
        //****************************+ */
        function getUsuarioIdUsuario($idUsuario = ""){
            if(!empty($idUsuario))
            {
                $query = "SELECT * FROM " . $this->usuario->getDbTable() . " WHERE idUsuario = " . $idUsuario;
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
                $num = $stmt->rowCount();
                if($num>0)
                {
                    $datosArray=array();
                    $datosArray["datos"]=array();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($row);
                        $dateItem=array(
                            "idUsuario" => $idUsuario,
                            "nombre" => $nombre,
                            "apellido" => $apellido,
                            "correo" => $correo,
                            "estado" => $estado
                        );
                        array_push($datosArray["datos"], $dateItem);
                    }
                    
                    $codigoHttp = 200;
                    http_response_code($codigoHttp);
                    echo json_encode(
                        array(  "Clase" => $this->usuario->getDbTable(), 
                                "Cantidad" => $num,
                                "mensaje" => "Registros Encontrados.",
                                "codigoHttp" => $codigoHttp,
                                "mensajeHttp" => codigoErrorHttp($codigoHttp),
                                "registros" => $datosArray
                            )
                    );
                }else{
                    $codigoHttp = 404;
                    http_response_code($codigoHttp);
                    echo json_encode(
                        array(  "Clase" => $this->usuario->getDbTable(), 
                                "Cantidad" => $num,
                                "mensaje" => "No se encontraron registros.",
                                "codigoHttp" => $codigoHttp,
                                "mensajeHttp" => codigoErrorHttp($codigoHttp),
                                "registros" => []
                            )
                    );
                }
            }else{
                //RESPUESTA - Parametros enviados vacios.
                $codigoHttp = 400;
                http_response_code($codigoHttp);
                echo json_encode(
                    array(  "Clase" => $this->usuario->getDbTable(), 
                            "Cantidad" => 0,
                            "mensaje" => "Datos enviados incompletos, se requiere un codigo para: " . $objeto->getDbTable(),
                            "codigoHttp" => $codigoHttp,
                            "mensajeHttp" => codigoErrorHttp($codigoHttp),
                            "registros" => []
                        )
                );
            }
        }

        //****************************+ */
        // Obtiene el Usuario por Correo
        //****************************+ */
        function getUsuarioCorreo($correo = ""){
            if(!empty($correo))
            {
                $query = "SELECT * FROM " . $this->usuario->getDbTable() . " WHERE correo = '" . $correo . "'";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
                $num = $stmt->rowCount();
                if($num>0)
                {
                    $datosArray=array();
                    $datosArray["datos"]=array();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($row);
                        $dateItem=array(
                            "idUsuario" => $idUsuario,
                            "nombre" => $nombre,
                            "apellido" => $apellido,
                            "correo" => $correo,
                            "estado" => $estado
                        );
                        array_push($datosArray["datos"], $dateItem);
                    }
                    
                    $codigoHttp = 200;
                    http_response_code($codigoHttp);
                    echo json_encode(
                        array(  "Clase" => $this->usuario->getDbTable(), 
                                "Cantidad" => $num,
                                "mensaje" => "Registros Encontrados.",
                                "codigoHttp" => $codigoHttp,
                                "mensajeHttp" => codigoErrorHttp($codigoHttp),
                                "registros" => $datosArray
                            )
                    );
                }else{
                    $codigoHttp = 404;
                    http_response_code($codigoHttp);
                    echo json_encode(
                        array(  "Clase" => $this->usuario->getDbTable(), 
                                "Cantidad" => $num,
                                "mensaje" => "No se encontraron registros con el correo: " . $correo,
                                "codigoHttp" => $codigoHttp,
                                "mensajeHttp" => codigoErrorHttp($codigoHttp),
                                "registros" => []
                            )
                    );
                }
            }else{
                //RESPUESTA - Parametros enviados vacios.
                $codigoHttp = 400;
                http_response_code($codigoHttp);
                echo json_encode(
                    array(  "Clase" => $this->usuario->getDbTable(), 
                            "Cantidad" => 0,
                            "mensaje" => "Datos enviados incompletos, se requiere un correo para: " . $objeto->getDbTable(),
                            "codigoHttp" => $codigoHttp,
                            "mensajeHttp" => codigoErrorHttp($codigoHttp),
                            "registros" => []
                        )
                );
            }
        }

        //****************************+ */
        // Obtiene el Usuario por Usuario y contraseña
        //****************************+ */
        function validacionUsuario($dato = []){
            $correo = $dato['correo'];
            $clave = $dato['clave'];

            if(!empty($correo) && !empty($clave))
            {
                $query = "SELECT * FROM " . $this->usuario->getDbTable() . " WHERE correo = '" . $correo . "'";

                $stmt = $this->conn->prepare($query);
                $stmt->execute();
                $num = $stmt->rowCount();
                if($num>0)
                {
                    $datosArray=array();
                    $datosArray["datos"]=array();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($row);
                        $dateItem=array(
                            "idUsuario" => $idUsuario,
                            "nombre" => $nombre,
                            "apellido" => $apellido,
                            "correo" => $correo,
                            "contrasena" => $contrasena,
                            "estado" => $estado
                        );
                        array_push($datosArray["datos"], $dateItem);
                    }

                    //Valido el hash con la clave que ingreso.
                    $validaHash = $this->classContrasena->verify($clave, $datosArray["datos"][0]["contrasena"]);
                    if ($validaHash){
                        echo "es verdad";
                    }else{
                        echo "es falso";
                    }
                    //
                }else{
                    echo "No existen datos";
                }
            }else{
                echo "Debes ingresar un usuario y contraseña";
            }
        }

        //****************************+ */
        // Almacena un nuevo usuario FALLLLLLTAAAAAAAAAAAAA
        // $contrasenaHash = $this->classContrasena->hash($clave);
        // Solo debe existir un correo por persona 
        //****************************+ */
        public function creaUsuario($objeto){
            if(
                !empty($objeto->getIdUsuario())  &&
                !empty($objeto->getNombre())     &&
                !empty($objeto->getApellido())   &&
                !empty($objeto->getContrasena()) &&
                !empty($objeto->getCorreo())     &&
                !empty($objeto->getEstado())
            ){
                $query = "INSERT INTO " . $objeto->getDbTable() . " 
                SET idUsuario=:idUsuario, nombre=:nombre, apellido=:apellido, contrasena=:contrasena, correo=:correo, estado=:estado";
                $stmt = $this->conn->prepare($query);
                //sanitize validar por el tipo de DATO
                $objeto->setIdUsuario(htmlspecialchars(strip_tags($objeto->getIdUsuario())));
                $objeto->setNombre(htmlspecialchars(strip_tags($objeto->getNombre())));
                $objeto->setApellido(htmlspecialchars(strip_tags($objeto->getApellido())));
                $objeto->setCorreo(htmlspecialchars(strip_tags($objeto->getCorreo())));
                $objeto->setEstado(htmlspecialchars(strip_tags($objeto->getEstado())));
                $stmt->bindValue(":idUsuario", $objeto->getIdUsuario());
                $stmt->bindValue(":nombre", $objeto->getNombre());
                $stmt->bindValue(":apellido", $objeto->getApellido());
                $stmt->bindValue(":contrasena", doEncrypt($objeto->getContrasena()));
                $stmt->bindValue(":correo", $objeto->getCorreo());
                $stmt->bindValue(":estado", $objeto->getEstado());
                try{
                    if($stmt->execute()){
                        //RESPUESTA - CREACION CON EXITO
                        $codigoHttp = 201;
                        http_response_code($codigoHttp);
                        echo json_encode(
                            array(  "Clase" => $objeto->getDbTable(), 
                                    "Cantidad" => 1,
                                    "mensaje" => "Registro Almacenado.",
                                    "codigo" => $objeto->getIdUsuario(),
                                    "codigoHttp" => $codigoHttp,
                                    "mensajeHttp" => codigoErrorHttp($codigoHttp))
                        );
                        return true;
                    }else{
                        //RESPUESTA - ERROR AL EJECUTAR LA CONSULTA
                        $codigoHttp = 503;
                        http_response_code($codigoHttp);
                        echo json_encode(
                            array(  "Clase" => $objeto->getDbTable(), 
                                    "Cantidad" => 0,
                                    "mensaje" => "Registro no almacenado.",
                                    "codigo" => 0,
                                    "codigoHttp" => $codigoHttp,
                                    "mensajeHttp" => codigoErrorHttp($codigoHttp))
                        );
                        return false;
                    }
                }catch(PDOException $exception){
                    //RESPUESTA - ERROR CAPTURADO EN EXCEPCION
                    $codigoHttp = 422;
                    http_response_code($codigoHttp);
                    echo json_encode(
                        array(  "Clase" => $objeto->getDbTable(), 
                                "Cantidad" => 0,
                                "mensaje" => $exception->getMessage(),
                                "codigo" => 0,
                                "codigoHttp" => $codigoHttp,
                                "mensajeHttp" => codigoErrorHttp($codigoHttp))
                    );
                    return false;
                }
            }else{
                //RESPUESTA - DATOS INCOMPLETOS
                $codigoHttp = 400;
                http_response_code($codigoHttp);
                echo json_encode(
                    array(  "Clase" => $objeto->getDbTable(), 
                            "Cantidad" => 0,
                            "mensaje" => "Datos enviados incompletos",
                            "codigo" => 0,
                            "codigoHttp" => $codigoHttp,
                            "mensajeHttp" => codigoErrorHttp($codigoHttp))
                );
                return false;
            }        
        }

        //****************************+ */
        // Modifica un los datos de un usuario FALLLLLLTAAAAAAAAAAAAA
        //****************************+ */
        public function modificaUsuario($objeto){
            if( !empty($objeto->getIdUsuario()) ){
                $usuarioDao = new UsuarioDao();
                $arrayDatoBuscado = $usuarioDao->getUsuarioIdUsuario($objeto->getIdUsuario());
                $usuarioDao = null;
                echo "Falta implementar";
                
            }else{
                //RESPUESTA - DATOS INCOMPLETOS
                $codigoHttp = 400;
                http_response_code($codigoHttp);
                echo json_encode(
                    array(  "Clase" => $objeto->getDbTable(), 
                            "Cantidad" => 0,
                            "mensaje" => "Datos enviados incompletos, se requiere un codigo para: " . $objeto->getDbTable(),
                            "codigo" => 0,
                            "codigoHttp" => $codigoHttp,
                            "mensajeHttp" => codigoErrorHttp($codigoHttp))
                );
                return false;
            }        
        }

        //****************************+ */
        // Elimina un registro de la BD FALLLLLLTAAAAAAAAAAAAA
        //****************************+ */
        public function delUsuario(Usuario $user, Varchar $tipoRespuesta){
            echo "delUsuario";
        }

    }
    

?>
