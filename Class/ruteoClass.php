<?php

class Usuario {
    //******************************* */
    //*********** Table ***********
    //******************************* */
    
    private $dbTable = "Usuario";

    //******************************* */
    //*********** Columns ***********
    //******************************* */
    private $idUsuario;
    private $nombre;
    private $apellido;
    private $contrasena;
    private $correo;
    private $estado; // A-Activo;P-Pasivo

    //******************************* */
    //*********** Constructor ***********
    //******************************* */
    function __construct($idUsuario = 0, $nombre = "", $apellido = "", $contrasena = "", $correo = "", $estado = "") {
        $this->dbTable = $this->dbTable;
        $this->idUsuario = $idUsuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->contrasena = $contrasena;
        $this->correo = $correo;
        $this->estado = $estado;
    }
    //******************************* */
    //*********** GET ***********
    //******************************* */
    public function getDbTable()
    {
        return $this->dbTable;
    }
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getApellido()
    {
        return $this->apellido;
    }
    public function getContrasena()
    {
        return $this->contrasena;
    }
    public function getCorreo()
    {
        return $this->correo;
    }
    public function getEstado()
    {
        return $this->estado;
    }

    //******************************* */
    //*********** SET ***********
    //******************************* */
    public function setDbTable($dbTable)
    {
        $this->dbTable = $dbTable;
        return $this;
    }
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
        return $this;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
        return $this;
    }
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
        return $this;
    }
    public function setCorreo($correo)
    {
        $this->correo = $correo;
        return $this;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }

}

?>
