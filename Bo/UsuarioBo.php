<?php

    include_once '../Dao/UsuarioDao.php';
    include_once '../Class/Usuario.php';
    include_once '../Config/Utilidades.php';

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

                case "usuarios/modifica/put": // Cuando modifico un dato del usuario
                    $datos = $this->userDao->modificaUsuario($dato);
                    break;
                
                case "usuarios/del/del": // Elimino un usuario de la BD
                    $datos = $this->userDao->eliminaUsuario($dato);
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
        }
    }
?>