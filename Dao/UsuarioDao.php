<?php
    include_once '../Config/Database.php';
    include_once '../Class/Usuario.php';
    include_once '../Config/Utilidades.php';
    include_once '../Config/Contrasena.php';

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

        //****************************
        // Obtiene todos los Usuarios
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
                echo json_encode( seteaMensaje("",
                    $this->usuario->getDbTable(),
                    $num,
                    "",
                    "",
                    "Registros Encontrados.",
                    200,
                    $datosArray
                ));
            }else{
                echo json_encode( seteaMensaje("",
                    $this->usuario->getDbTable(),
                    $num,
                    "",
                    "",
                    "No se encontraron registros.",
                    404,
                    []
                ));
            }
        }

        //****************************+
        // Obtiene el Usuario por id
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
                    echo json_encode( seteaMensaje("",
                        $this->usuario->getDbTable(),
                        $num,
                        "",
                        "",
                        "Registros Encontrados.",
                        200,
                        $datosArray
                    ));
                }else{
                    echo json_encode( seteaMensaje("",
                        $this->usuario->getDbTable(),
                        $num,
                        "",
                        "",
                        "No se encontraron registros.",
                        404,
                        []
                    ));
                }
            }else{
                //RESPUESTA - Parametros enviados vacios.
                echo json_encode( seteaMensaje("",
                    $this->usuario->getDbTable(),
                    0,
                    "",
                    "",
                    "Datos enviados incompletos, se requiere un codigo para: " . $objeto->getDbTable(),
                    400,
                    []
                ));
            }
        }

        //****************************
        // Obtiene el Usuario por Correo
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
                    echo json_encode( seteaMensaje("",
                        $this->usuario->getDbTable(),
                        $num,
                        "",
                        "",
                        "Registros Encontrados.",
                        200,
                        $datosArray
                    ));
                }else{
                    echo json_encode( seteaMensaje("",
                        $this->usuario->getDbTable(),
                        $num,
                        "",
                        "",
                        "No se encontraron registros con el correo: " . $correo,
                        404,
                        []
                    ));
                }
            }else{
                //RESPUESTA - Parametros enviados vacios.
                echo json_encode( seteaMensaje("",
                    $this->usuario->getDbTable(),
                    $num,
                    "",
                    "",
                    "Datos enviados incompletos, se requiere un correo para: " . $objeto->getDbTable(),
                    400,
                    []
                ));
            }
        }

        //****************************
        // Obtiene el Usuario por Usuario y contraseña
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
                        echo json_encode( seteaMensaje("",
                            $this->usuario->getDbTable(),
                            $num,
                            "",
                            "",
                            "Registros Encontrados.",
                            200,
                            $datosArray
                        ));
                    }else{
                        echo json_encode( seteaMensaje("",
                            $this->usuario->getDbTable(),
                            0,
                            "",
                            "",
                            "Error en ingreso de credenciales.",
                            404,
                            []
                        ));
                    }
                    //
                }else{
                    echo json_encode( seteaMensaje("",
                        $this->usuario->getDbTable(),
                        0,
                        "",
                        "",
                        "No existe este correo que ingresaste.",
                        404,
                        []
                    ));
                }
            }else{
                echo json_encode( seteaMensaje("",
                    $this->usuario->getDbTable(),
                    0,
                    "",
                    "",
                    "Debes ingresar usuario y contraseña para procesar tu solicitud.",
                    404,
                    []
                ));
            }
        }

        //****************************
        // Almacena un nuevo usuario
        // Solo debe existir un correo por persona 
        public function creaUsuario($dato = []){
            //Recupero y valido si los campos estan llenos
            $errorDatos = false;
            if(empty(trim($dato["idUsuario"])))
                $errorDatos = true;
            if(empty(trim($dato["nombre"])))
                $errorDatos = true;
            if(empty(trim($dato["apellido"])))
                $errorDatos = true;
            if(empty(trim($dato["contrasena"])))
                $errorDatos = true;
            if(empty(trim($dato["correo"])))
                $errorDatos = true;

            $userClass = 
                new Usuario(
                        trim($dato["idUsuario"]), 
                        trim($dato["nombre"]), 
                        trim($dato["apellido"]), 
                        $this->classContrasena->hash(trim($dato["contrasena"])), 
                        trim($dato["correo"]), 
                        "A");
            
            if(!$errorDatos){
                $query = "Insert into " . $this->usuario->getDbTable();
                $query = $query . " (idUsuario, nombre, apellido, contrasena, correo, estado)";
                $query = $query . " VALUES (:idUsuario, :nombre, :apellido, :contrasena, :correo, :estado) ";
                
                $stmt = $this->conn->prepare($query);
                $stmt->bindValue(":idUsuario", $userClass->getIdUsuario());
                $stmt->bindValue(":nombre", $userClass->getNombre());
                $stmt->bindValue(":apellido", $userClass->getApellido());
                $stmt->bindValue(":contrasena", $userClass->getContrasena());
                $stmt->bindValue(":correo", $userClass->getCorreo());
                $stmt->bindValue(":estado", $userClass->getEstado());

                try{
                    if($stmt->execute()){
                        //RESPUESTA - CREACION CON EXITO
                        echo json_encode( seteaMensaje("",
                            $this->usuario->getDbTable(),
                            1,
                            "",
                            "",
                            "Registro Almacenado.",
                            201,
                            []
                        ));
                        return true;
                    }else{
                        //RESPUESTA - ERROR AL EJECUTAR LA CONSULTA
                        echo json_encode( seteaMensaje("",
                            $this->usuario->getDbTable(),
                            0,
                            "",
                            "",
                            "Consulta no se ejecuto.",
                            503,
                            []
                        ));
                        return false;
                    }
                }catch(PDOException $exception){
                    //RESPUESTA - ERROR CAPTURADO EN EXCEPCION
                    echo json_encode( seteaMensaje("",
                        $this->usuario->getDbTable(),
                        0,
                        "",
                        "",
                        $exception->getMessage(),
                        422,
                        []
                    ));
                    return false;
                }
            }else
            {
                echo json_encode( seteaMensaje("",
                    $this->usuario->getDbTable(),
                    0,
                    "",
                    "",
                    "Error faltan datos necesarios para procesar el registro.",
                    404,
                    []
                ));
            }      
        }

        //****************************
        // Modifica un los datos de un usuario FALLLLLLTAAAAAAAAAAAAA
        public function modificaUsuario($dato = []){
            //Recupero y valido si los campos estan llenos
            $errorDatos = false;
            if(empty(trim($dato["idUsuario"])))
                $errorDatos = true;
            if(empty(trim($dato["nombre"])))
                $errorDatos = true;
            if(empty(trim($dato["apellido"])))
                $errorDatos = true;
            if(empty(trim($dato["contrasena"])))
                $errorDatos = true;
            if(empty(trim($dato["correo"])))
                $errorDatos = true;

            $userClass = 
            new Usuario(
                    trim($dato["idUsuario"]), 
                    trim($dato["nombre"]), 
                    trim($dato["apellido"]), 
                    $this->classContrasena->hash(trim($dato["contrasena"])), 
                    trim($dato["correo"]), 
                    "A");
            if(!$errorDatos){
                $query = "Update " . $this->usuario->getDbTable();
                $query = $query . " set ";
                $query = $query . " nombre = :nombre, ";
                $query = $query . " apellido = :apellido, ";
                $query = $query . " contrasena = :contrasena, ";
                $query = $query . " correo = :correo, ";
                $query = $query . " estado = :estado ";
                $query = $query . " Where idUsuario = :idUsuario ";
                
                $stmt = $this->conn->prepare($query);
                $stmt->bindValue(":nombre", $userClass->getNombre());
                $stmt->bindValue(":apellido", $userClass->getApellido());
                $stmt->bindValue(":contrasena", $userClass->getContrasena());
                $stmt->bindValue(":correo", $userClass->getCorreo());
                $stmt->bindValue(":estado", $userClass->getEstado());
                $stmt->bindValue(":idUsuario", $userClass->getIdUsuario());

                try{
                    if($stmt->execute()){
                        //RESPUESTA - CREACION CON EXITO
                        echo json_encode( seteaMensaje(
                            $this->usuario->getDbTable(),
                            1,
                            "Modificación ejecutada.",
                            201,
                            []
                        ));
                        return true;
                    }else{
                        //RESPUESTA - ERROR AL EJECUTAR LA CONSULTA
                        echo json_encode( seteaMensaje(
                            $this->usuario->getDbTable(),
                            0,
                            "Modificación no ejecutada.",
                            503,
                            []
                        ));
                        return false;
                    }
                }catch(PDOException $exception){
                    //RESPUESTA - ERROR CAPTURADO EN EXCEPCION
                    echo json_encode( seteaMensaje(
                        $this->usuario->getDbTable(),
                        0,
                        $exception->getMessage(),
                        422,
                        []
                    ));
                    return false;
                }
            }else
            {
                echo json_encode( seteaMensaje(
                    $this->usuario->getDbTable(),
                    0,
                    "Error faltan datos para procesar la información.",
                    404,
                    []
                ));
            }
        }

        //****************************+
        // Elimina un registro de la BD FALLLLLLTAAAAAAAAAAAAA
        public function delUsuario(Usuario $user, Varchar $tipoRespuesta){
            echo "delUsuario";
        }

    }
    

?>
