<?php
Class Pasajero {

    private $nombre;
    private $apellido;
    private $DNI;
    private $telefono;
    private $nroAsiento;
    private $nroTicket;

    public function __construct($n,$ap,$doc,$tel,$nroA,$nroT){
        $this->nombre = $n;
        $this->apellido = $ap;
        $this->DNI = $doc;
        $this->telefono = $tel;
        $this->nroAsiento = $nroA;
        $this->nroTicket = $nroT;
    }
    public function getName(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getDNI(){
        return $this->DNI;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function getNroAsiento(){
        return $this->nroAsiento;
    }
    public function getnroTicket(){
        return $this->nroTicket;
    }
    public function setNombre($name){
        $this->nombre = $name;
    }
    public function setApellido($lastName){
        $this->apellido = $lastName;
    }

    public function setDNI($documento){
        $this->DNI = $documento;
    }

    public function setTelefono($ptel){
        $this->telefono = $ptel;
    }

    public function setNroAsiento($pAsiento){
        $this->nroAsiento = $pAsiento;
    }

    public function serNroTicket($pTicket){
        $this->nroTicket = $pTicket;
    }

    public function __toString(){
        return "Nombre y Apellido: ".$this->getName()." ".$this->getApellido()." \n"."DNI: ".$this->getDNI()."\n". "Telefono: ".$this->getTelefono()." | nro de asiento: ".$this->getNroAsiento(). " | nro de ticket: ".$this->getNroTicket();
    }

    public function darPorcentajeIncremento(){
        $porcentajeIncremento = 0;
        return $porcentajeIncremento;
    }
}