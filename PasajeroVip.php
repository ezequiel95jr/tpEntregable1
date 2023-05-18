<?php
Class PasajeroVip extends Pasajero{
    private $nroViajeroFrecuente;
    private $millas;
    
    public function __construct($nom,$apellido,$numAsiento,$numTicket, $dni, $tel,$numViajeroF,$pmillas){
        parent::__construct($nom,$apellido,$numAsiento,$numTicket, $dni, $tel);
        $this->nroViajeroFrecuente = $numViajeroF;
        $this->millas = $pmillas;
    }
    
    public function getNroFrecuente(){
        return $this->nroViajeroFrecuente;
    }
    public function getMillas(){
        return $this->millas;
    }

    public function setNroFrecuente($pF){
        $this->nroViajeroFrecuente = $pF;
    }
    public function setMillas($pmillas){
        $this->millas = $pmillas;
    }

    public function darPorcentajeIncremento(){
        $porcentajeVIP = parent::darPorcentajeIncremento();
        if( $this->getMillas()>= 300 ){
            $porcentajeVIP = $porcentajeVIP + 30;
        }
        else{
            $porcentajeVIP = $porcentajeVIP + 35;
        }
        return $porcentajeVIP;
    }
    public function __toString(){
        $cadena1 = parent::__toString();
        return $cadena1. " | número de viajero Frecuente: ".$this->getNroFrecuente()." | Cantidad de millas acumuladas: ".$this->getMillas();
    }
}