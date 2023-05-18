<?php
Class PasajeroEsp extends Pasajero{
    private $comidaEspecial;    //booleano
    private $sillaDeRueda;      //booleano
    private $asistencia;        //booleano

    public function __construct($nom,$apellido,$numAsiento,$numTicket, $dni, $tel, $pcomida,$psilla,$pasistencia){
        parent::__construct($nom,$apellido,$numAsiento,$numTicket, $dni, $tel);
        $this->comidaEspecial = $pcomida;
        $this->sillaDeRueda = $psilla;
        $this->asistencia = $pasistencia;
    }

    public function getComidaEspecial(){
        return $this->comidaEspecial;
    }
    public function getSillaDeRueda(){
        return $this->sillaDeRueda;
    }
    public function getAsistencia(){
        return $this->asistencia;
    }

    public function setComidaEspecial($valor1){
        $this->comidaEspecial = $valor1;
    }
    public function setSillaDeRueda($valor2){
        $this->sillaDeRueda = $valor2;
    }
    public function setAsistencia($valor3){
        $this->asistencia = $valor3;
    }
    
    public function showValores($p1,$p2,$p3){

        
    }

    public function __toString(){
        $cadena1 = parent::__toString();
        return $cadena1 . "     |   ";
    }

    public function darPorcentajeIncremento(){
        $porcentajeEsp = parent::darPorcentajeIncremento(); 
        if( $this->getComidaEspecial() && $this->getSillaDeRueda() && $this->getAsistencia()){
            $porcentajeEsp = $porcentajeEsp + 30;
        }
        elseif($this->getComidaEspecial() && !$this->getSillaDeRueda() && !$this->getAsistencia()){
            $porcentajeEsp = $porcentajeEsp + 15;
        }
        elseif( !$this->getComidaEspecial() && $this->getSillaDeRueda() && !$this->getAsistencia() ){
            $porcentajeEsp = $porcentajeEsp + 15;
        }
        else if ( !$this->getComidaEspecial() && !$this->getSillaDeRueda() && $this->getAsistencia()){
            $porcentajeEsp = $porcentajeEsp + 15;
        }
        return $porcentajeEsp;
    }

}