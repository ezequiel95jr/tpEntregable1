<?php
Class Viaje{
    private $codViaje;
    private $destino;
    private $cantMax;
    private $pasajeros;
    //////////// METODOS DE ACCESO ////////////////
    public function __construct($codigo,$dest,$cant,$pasajeros){
        $this->codViaje = $codigo;
        $this->destino = $dest;
        $this->cantMax = $cant;
        $this->pasajeros = [];
    }

    public function getCodViaje(){
        return $this->codViaje;
    }
    public function getDestino(){
        return $this->destino;
    }
    public function getCantMax(){
        return $this->cantMax;
    }
    public function getPasajeros(){
        return $this->pasajeros;
    }
    public function setCodigo($c){
        $this->codViaje = $c;
    }
    public function setDestino($d){
        $this->destino = $d;
    }
    public function setCantMax($cm){
        $this->cantMax=$cm;
    }
    public function setPasajeros($p){
        $this->pasajeros=$p;
    }
    public function __toString(){
        return "Codigo del vieje: ".$this->getCodViaje().", Destino: ".$this->getDestino().", Cantidad maxima: ".$this->getcantMax().$this->showPasajeros1()."\n";
    }
    public function showPasajeros1(){
        for($i=0;$i<count($this->getPasajeros());$i++){
            echo "Pasajero n°".($i+1)."\n";
            echo "Nombre: ".$this->getPasajeros()[$i]["Nombre"]."\n";
            echo "Apellido: ".$this->getPasajeros()[$i]["Apellido"]."\n";
            echo "DNI: ".$this->getPasajeros()[$i]["DNI"]."\n";
            echo "-------------------------------------\n";
        }}

    public function modificator($dato, $clave){

        switch($clave){
            case 1: //clave = codigo
                $this->setCodigo($dato);
            break;
            case 2: //clave = destino
                $this->setDestino($dato);
            break;
            case 3: //clave = cantidad maxima de pasajeros
                $this->setCantMax($dato);        
        }
    } 

    public function buscandoPasajero($doc){
        $i=0;
        $found = false;
        $posicionPasajero = -1;
        while($i<count($this->getPasajeros()) && $found == false){
            if( $doc == $this->getPasajeros()[$i]["DNI"] ){
                // encontró al pasajero buscado
                $posicionPasajero = $i;
                $found = true;
            }
            $i = $i+1;
        }
        return $posicionPasajero;
    }
    public function muestraDatos($i){
        return $this->getPasajeros()[$i]["Nombre"]." ".$this->getPasajeros()[$i]["Apellido"].", DNI: ".$this->getPasajeros()[$i]["DNI"]."\n";
    }

}