<?php

    include_once '../Dao/UsuarioDao.php';
    include_once '../Class/Usuario.php';

    Class UsuarioBo{
        private $userDao = null; //Class

        function __construct() {
            $this->userDao = new UsuarioDao();
        }
        public function __destruct(){
        }

        //Derivo al metodo correspondiente
        function consultaBo($entidad = "", $metodo = "", $dato = "", $metodoServidor = ""){
            $accesoMetodo = $entidad . "/" . $metodo . "/" . $metodoServidor;
            switch($accesoMetodo)
            {
                case "usuarios/all/get": //Recupera todos los usuarios
                    $datos = $this->userDao->getAllUsuarios();
                    break;

                case "usuarios/id/get": //Recupera el usuario por el Id
                    $datos = $this->userDao->getUsuarioIdUsuario($dato);
                    break;

                case "usuarios/correo/get": //Recupera el usuario por el correo
                    $datos = $this->userDao->getUsuarioCorreo($dato);
                    break;

                case "usuarios/validate/post": //Validar las credenciales y devuelve un token
                    $datos = $this->userDao->validacionUsuario($dato);
                    break;

                case "usuarios/crea/post": //Cuando creo un nuevo usuario
                    $datos = $this->userDao->creaUsuario($dato);                    
                    break;

                case "usuarios/put/put": // Cuando modifico un dato del usuario
                    $userClass = new Usuario();
                    $userClass->setIdUsuario(500857); //Obligado llevar
                    $userClass->setNombre("Jefferson Javier"); //Campos a modificar
                    $datos = $this->userDao->modificaUsuario($userClass);
                    break;
                
                case "usuarios/del/del": // Elimino un usuario de la BD
                    $datos = $this->userDao->eliminaUsuario($dato);
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
        }
    }
?>