<?php

class Coordenadas {
    //******************************* */
    //*********** Table ***********
    //******************************* */
    
    private $dbTable = "YPITBMTO0001596";

    //******************************* */
    //*********** Columns ***********
    //******************************* */
    private $fecha;
    private $ruta;
    private $secuencia;
    private $cliente;
    private $tipo_pedido; //111 Contado || 113 Credito
    private $hora_inicio;
    private $hora_fin;
    private $tipo_transaccion; // 1 venta || 2 No venta || 3 No visita
    private $total; 
    private $latitud; 
    private $longitud; 

    //******************************* */
    //*********** Constructor ***********
    //******************************* */
    function __construct($fecha = "", 
                        $ruta = "", 
                        $secuencia = "", 
                        $cliente = "", 
                        $tipo_pedido = "", 
                        $hora_inicio = "",
                        $hora_fin = "", 
                        $tipo_transaccion = "", 
                        $total = "", 
                        $latitud = "", 
                        $longitud = "") {
        $this->dbTable = $this->dbTable;
        $this->fecha = $fecha;
        $this->ruta = $ruta;
        $this->secuencia = $secuencia;
        $this->cliente = $cliente;
        $this->tipo_pedido = $tipo_pedido;
        $this->hora_inicio = $hora_inicio;
        $this->hora_fin = $hora_fin;
        $this->tipo_transaccion = $tipo_transaccion;
        $this->total = $total;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
    }

    //******************************* */
    //*********** GET ***********
    //******************************* */
    public function getDbTable()
    {
        return $this->dbTable;
    }
    
    public function getFecha()
    {
        return $this->fecha;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    public function getSecuencia()
    {
        return $this->secuencia;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function getTipo_pedido()
    {
        return $this->tipo_pedido;
    }

    public function getHora_inicio()
    {
        return $this->hora_inicio;
    }

    public function getHora_fin()
    {
        return $this->hora_fin;
    }

    public function getTipo_transaccion()
    {
        return $this->tipo_transaccion;
    }

    public function getTotal()
    {
            return $this->total;
    }

    public function getLatitud()
    {
            return $this->latitud;
    }

    public function getLongitud()
    {
            return $this->longitud;
    }

    //******************************* */
    //*********** SET ***********
    //******************************* */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
        return $this;
    }

    public function setRuta($ruta)
    {
        $this->ruta = $ruta;
        return $this;
    }

    public function setSecuencia($secuencia)
    {
        $this->secuencia = $secuencia;
        return $this;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
        return $this;
    }

    public function setTipo_pedido($tipo_pedido)
    {
        $this->tipo_pedido = $tipo_pedido;
        return $this;
    }

    public function setHora_inicio($hora_inicio)
    {
        $this->hora_inicio = $hora_inicio;
        return $this;
    }

    public function setHora_fin($hora_fin)
    {
        $this->hora_fin = $hora_fin;
        return $this;
    }

    public function setTipo_transaccion($tipo_transaccion)
    {
        $this->tipo_transaccion = $tipo_transaccion;
        return $this;
    }

    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
        return $this;
    }

    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
        return $this;
    }
}

?>
