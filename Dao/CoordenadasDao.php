<?php
    include_once '../Config/Database.php';
    include_once '../Class/Coordenadas.php';
    include_once '../Config/Utilidades.php';

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
                    "Registros Encontrados.",
                    200,
                    $datosArray
                ));
            }else{
                echo json_encode( seteaMensaje(
                    $this->coordenadas->getDbTable(),
                    $num,
                    "No se encontraron registros.",
                    404,
                    []
                ));
            }
        }

        //****************************
        // Obtiene todas las coordenadas por ruta
        function getCoordenadasRuta($ruta = ""){
            $query = "SELECT * FROM " . $this->coordenadas->getDbTable() . " WHERE Ruta = '". $ruta ."' ";
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
                    "Registros Encontrados.",
                    200,
                    $datosArray
                ));
            }else{
                echo json_encode( seteaMensaje(
                    $this->coordenadas->getDbTable(),
                    $num,
                    "No se encontraron registros.",
                    404,
                    []
                ));
            }
        }
    }
?>
