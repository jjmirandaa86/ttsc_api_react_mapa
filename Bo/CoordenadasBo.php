<?php

    include_once '../Dao/CoordenadasDao.php';
    include_once '../Class/Coordenadas.php';
    include_once '../Config/Utilidades.php';

    Class CoordenadasBo{
        private $coordenadasDao = null; //Class

        function __construct() {
            $this->coordenadasDao = new CoordenadasDao();
        }
        public function __destruct(){
        }

        //Derivo al metodo correspondiente
        function consultaBo($entidad = "", $metodo = "", $dato = "", $metodoServidor = "", $parametroUrl = "", $parametroUrlDato = 0 ){
            $accesoMetodo = $entidad . "/" . $metodo . "/" . $metodoServidor;
            switch($accesoMetodo)
            {
                case "coordenadas/ruta/get": //Recupera las coordenadas por ruta 
                    if ($parametroUrlDato === 0){
                        $datos = $this->coordenadasDao->getCoordenadasRuta($dato);
                    }
                    else{ 
                        $datos = $this->coordenadasDao->getCoordenadasRuta($dato, $parametroUrlDato);
                    }
                    break;
                    
                case "coordenadas/grafico/get": //Recupera los datos para el grafico
                    $datos = $this->coordenadasDao->getTotalValorizadoDiaXRuta($dato);
                    break;

                case "coordenadas/fecha/post": //recupero los datos por fecha inicio y fin
                    $datos = $this->coordenadasDao->getCoordenadasFecha($dato);
                    break;

                case "coordenadas/fecharuta/post": //recupero los datos por fecha inicio, fin y Ruta
                    $datos = $this->coordenadasDao->getCoordenadasFechaRuta($dato);
                    break;

                default:
                    echo json_encode( seteaMensaje("",
                        "Error, no existe el metodo buscado",
                        0,
                        "",
                        "",
                        "Metodo no implementado.",
                        404,
                        []
                    ));
                    break;
            }
        }
    }
?>