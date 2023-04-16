<?php
Class Responsable{
    /*
el número de empleado, número de licencia, nombre y apellido */
    private $nroEmpleado;
    private $nroLicencia;
    private $nombre;
    private $apellido;

    public function __construct($pNroEmpleado, $pNroLicencia,$pNombre,$pApellido){
        $this->nroEmpleado = $pNroEmpleado;
        $this->nroLicencia = $pNroLicencia;
        $this->nombre = $pNombre;
        $this->apellido = $pApellido;
    }
    public function getNroEmpleado(){
        return $this->nroEmpleado;
    }
    public function getNroLicencia(){
        return $this->nroLicencia;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function setNroEmpleado($pNroEmpleado){
        $this->nroEmpleado = $pNroEmpleado;
    }
    public function setNroLicencia($pLicencia){
        $this->nroLicencia = $pLicencia;
    }
    public function setNombre($pNombre){
        $this->nombre = $pNombre;
    }
    public function setApellido($pApellido){
        $this->apellido = $pApellido;
    }
    public function __toString(){
        return "Nro de empleado: ".$this->getNroEmpleado()." Nombre y apellido: ".$this->getNombre()." ".$this->getApellido()." Nro de licencia: ".$this->getNroLicencia()."\n";
    }
}