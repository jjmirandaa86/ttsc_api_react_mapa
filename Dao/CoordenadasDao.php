<?php
    include_once '../Config/Database.php';
    include_once '../Class/Coordenadas.php';
    include_once '../Config/Utilidades.php';
    include_once '../Config/Constantes.php';

    header("Access-Control-Allow-Origin: *"); //Solo select
    header("Content-Type: application/json; charset=UTF-8"); //Solo select
    header("Access-Control-Allow-Methods: POST"); //Solo select
    header("Access-Control-Max-Age: 3600"); //todos los 5 en update, crear 
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); //todos los 5 en update, , crear

    class CoordenadasDao{
        private $database = null; //Class
        private $coordenadas = null; //Class
        private $conn = null; //Objeto conexion

        function __construct() {
            $this->database = new Database();
            $this->coordenadas = new Coordenadas();
            $this->conn = $this->database->getConnection();
        }

        public function __destruct()
        {
            $this->conn = $this->database->closeConnection();
            $this->coordenadas = null;
        }

        //****************************
        // Obtiene todas las coordenadas por ruta
        function getCantidadRegistros($query){
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row["registros"];
        }

        //****************************
        // Obtiene todas los coordenadas
        function getAllCoordenadas(){
            $query = "SELECT * FROM " . $this->coordenadas->getDbTable(); 
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
                        "fecha" => $Fecha_original_de_la_transacción,
                        "ruta" => $Ruta,
                        "secuencia" => $Secuencia_de_visita,
                        "cliente" => $Código_de_cliente,
                        "tipo_pedido" => $Tipo_de_pedido,
                        "hora_inicio" => $Hora_de_inicio_de_visita,
                        "hora_fin" => $Hora_de_Fin_de_visita,
                        "tipo_transaccion" => $Tipo_de_transacción,
                        "total" => $Total_del_documento,
                        "latitud" => $coordenada_de_Latitud,
                        "longitud" => $Coordenada_de_Longitud
                    );
                    array_push($datosArray["datos"], $dateItem);
                }
                echo json_encode( seteaMensaje(
                    $this->coordenadas->getDbTable(),
                    $num,
                    "",
                    "",
                    "Registros Encontrados.",
                    200,
                    $datosArray
                ));
            }else{
                echo json_encode( seteaMensaje(
                    $this->coordenadas->getDbTable(),
                    0,
                    "",
                    "",
                    "No se encontraron registros.",
                    404,
                    []
                ));
            }
        }

        //****************************
        // Obtiene todas las coordenadas por ruta
        function getCoordenadasRuta($ruta = "", $limiteInicio = 0){
            $queryS = QUERY_SELECT_FROM . $this->coordenadas->getDbTable();
            $queryW = QUERY_WHERE . " Ruta = '$ruta' ";
            $queryO = QUERY_ORDERBY . " Fecha_original_de_la_transacción desc, secuencia_de_visita asc ";
            $queryG = "";
            $queryL = "";

            //Para obtener el total de registros de la consulta
            $cantidadRegistros = $this->getCantidadRegistros(QUERY_SELECT_FROM_COUNT . $this->coordenadas->getDbTable() . $queryW);
            $urlNext = null;
            $urlPrevios = null;
            if(LIMITE){
                $queryL = QUERY_LIMIT . $limiteInicio . " ," . LIMITE_REGISTROS;
                $urlNext = devuelveUrlSiguiente(LIMITE_REGISTROS, $limiteInicio, $cantidadRegistros);
                $urlPrevios = devuelveUrlAnterior(LIMITE_REGISTROS, $limiteInicio);
            }

            $query = $queryS . $queryW . $queryO . $queryG . $queryL;
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
                    if (FORMATO_LEGIBLE_JSON){
                        $dateItem=array(
                            "fecha" => $Fecha_original_de_la_transacción,
                            "ruta" => $Ruta,
                            "secuencia" => $Secuencia_de_visita,
                            "cliente" => $Código_de_cliente,
                            "tipo_pedido" => $Tipo_de_pedido,
                            "hora_inicio" => $Hora_de_inicio_de_visita,
                            "hora_fin" => $Hora_de_Fin_de_visita,
                            "tipo_transaccion" => $Tipo_de_transacción,
                            "total" => $Total_del_documento,
                            "latitud" => $coordenada_de_Latitud,
                            "longitud" => $Coordenada_de_Longitud
                        );
                    }else{    
                        $dateItem=array(
                            $Fecha_original_de_la_transacción,
                            $Ruta,
                            $Secuencia_de_visita,
                            $Código_de_cliente,
                            $Tipo_de_pedido,
                            $Hora_de_inicio_de_visita,
                            $Hora_de_Fin_de_visita,
                            $Tipo_de_transacción,
                            $Total_del_documento,
                            $coordenada_de_Latitud,
                            $Coordenada_de_Longitud
                        );
                    }
                    array_push($datosArray["datos"], $dateItem);
                }
                echo json_encode( seteaMensaje("MENSAJE_URL_NEXT_PREVIOS",
                    $this->coordenadas->getDbTable(),
                    $cantidadRegistros,
                    $urlNext,
                    $urlPrevios,
                    "Registros Encontrados.",
                    200,
                    $datosArray
                ));
            }else{
                echo json_encode( seteaMensaje("",
                    $this->coordenadas->getDbTable(),
                    0,
                    "",
                    "",
                    "No se encontraron registros.",
                    404,
                    []
                ));
            }
        }
    }
?>
