<?php
Class Persona {

    private $nombre;
    private $apellido;
    private $DNI;
    private $telefono;

    public function __construct($n,$ap,$doc,$tel){
        $this->nombre = $n;
        $this->apellido = $ap;
        $this->DNI = $doc;
        $this->telefono = $tel;
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

    public function __toString(){
        return "Nombre y Apellido: ".$this->getName()." ".$this->getApellido()." \n"."DNI: ".$this->getDNI()."\n". "Telefono: ".$this->getTelefono();
    }
}