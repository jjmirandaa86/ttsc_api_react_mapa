<?php 
    include_once 'Core.php';
    
    class Database {
        public $conn;

        //******************************* */
        //Genera la conexión de la BD
        //******************************* */
        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
                $this->conn->setAttribute(  PDO::ATTR_ERRMODE, 
                                            PDO::ERRMODE_EXCEPTION 
                                         );
                $this->conn->exec("SET CHARACTER SET utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }

        //******************************* */
        //Cierra la conexión de la BD || Libera recursos
        //******************************* */
        public function closeConnection(){
            $this->conn = null;
        }
    }
    
?>