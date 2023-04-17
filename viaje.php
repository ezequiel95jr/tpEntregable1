<?php
Class Viaje{
    private $codViaje;
    private $destino;
    private $cantMax;
    private $pasajeros;                 // coleccion de obj persona
    private $responsable;               // obj responsable
    //////////// METODOS DE ACCESO ////////////////
    public function __construct($codigo,$dest,$cant,$pasajeros,$pResponsable){
        $this->codViaje = $codigo;
        $this->destino = $dest;
        $this->cantMax = $cant;
        $this->pasajeros = $pasajeros ;     // coleccion de obj pasajeros
        $this->responsable = $pResponsable;  // obj responsable
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
    public function getResponsable(){
        return $this->responsable;
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
        $this->pasajeros = $p;
    }
    public function setResponsable($pResponsable){
        $this->responsable = $pResponsable;
    }
    public function __toString(){
        $cadenaPasajeros = $this->showPasajeros1();
        return "Codigo del vieje: ".$this->getCodViaje().", Destino: ".$this->getDestino().", Cantidad maxima: ".$this->getcantMax()."\n". $cadenaPasajeros."Responsable: ".$this->getResponsable()->__toString();
    }
    public function showPasajeros1(){
        $cadena = "";
        $ArrayPasajeros = $this->getPasajeros();    //array de obj pasajeros
        for($i=0;$i<count($ArrayPasajeros);$i++){
            $cadena = $cadena. "\n Pasajero nro ".($i+1)."\n" . $ArrayPasajeros[$i]->__toString()."\n";
        }
        return $cadena;
    }

    public function modificator($dato, $clave){
        // modifica los datos del viaje
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
            if( $doc == $this->getPasajeros()[$i]->getDNI() ){
                // encontró al pasajero buscado
                $posicionPasajero = $i;
                $found = true;
            }
            $i = $i+1;
        }
        return $posicionPasajero;
    }
    public function muestraDatos($i){
        //$i es la posicion en el array que deseo mostrar
        return $this->getPasajeros()[$i]->getName()." ".$this->getPasajeros()[$i]->getApellido().", DNI: ".$this->getPasajeros()[$i]->getDNI()."\n";
    }
    
    public function cargaDatosViaje($pCodigo,$pDestino,$pCantMax){
        //carga los datos del viaje
        $this-> setCodigo($pCodigo);
        $this-> setDestino($pDestino);
        $this-> setCantMax($pCantMax);
    }
    public function cargarPasajero($pNombre, $pApellido, $pDNI,$tel){
        $colPasajeros = [];
        $colPasajeros = new Persona ($pNombre,$pApellido,$pDNI,$tel);
        $arrayPa = $this->getPasajeros();
        array_push($arrayPa,$colPasajeros);
        $this->setPasajeros($arrayPa);
    }
    public function modificaPasajero($dato, $indice, $id){
        $arrayPasajeros = $this->getPasajeros();
        switch($id){
            case 1: 
                $arrayPasajeros[$indice]->setNombre($dato);
            break;
            case 2: // apellido          
                $arrayPasajeros[$indice]->setApellido($dato);
            break;
            case 3: //DNI       
                $arrayPasajeros[$indice]->setDNI($dato);              
            break;
        }
        $this->setPasajeros($arrayPasajeros);
    }
}