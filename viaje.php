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
        $this->pasajeros = $pasajeros ;
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
        $this->pasajeros = $p;
    }
    public function __toString(){
        return "Codigo del vieje: ".$this->getCodViaje().", Destino: ".$this->getDestino().", Cantidad maxima: ".$this->getcantMax().$this->showPasajeros1()."\n";
    }
    public function showPasajeros1(){
        $ArrayPasajeros = $this->getPasajeros();
        for($i=0;$i<count($ArrayPasajeros);$i++){
            echo "Pasajero n°".($i+1)."\n";
            echo "Nombre: ".$ArrayPasajeros[$i]["Nombre"]."\n";
            echo "Apellido: ".$ArrayPasajeros[$i]["Apellido"]."\n";
            echo "DNI: ".$ArrayPasajeros[$i]["DNI"]."\n";
            echo "-------------------------------------\n";
            $this->setPasajeros($ArrayPasajeros);    
        }
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
    
    public function cargaDatosViaje($pCodigo,$pDestino,$pCantMax){
        //carga los datos del viaje
        $this-> setCodigo($pCodigo);
        $this-> setDestino($pDestino);
        $this-> setCantMax($pCantMax);
    }
    public function cargarPasajero($pNombre, $pApellido, $pDNI,$pIndice){
        $user = $this->getPasajeros();
        $user[$pIndice] = ["Nombre" => $pNombre, "Apellido"=> $pApellido, "DNI"=> $pDNI];
        $this->setPasajeros($user);
    }
    public function modificaPasajero($dato, $indice, $id){
        $user = $this->getPasajeros();
        switch($id){
            case 1: 
                //el dato es el nombre
                $user[$indice] = ["Nombre"=> $dato,"Apellido"=> $user[$indice]["Apellido"],"DNI"=>$user[$indice]["DNI"]];
                $this->setPasajeros($user);
            break;
            case 2: // apellido
                $user[$indice] = ["Nombre"=> $user[$indice]["Nombre"],"Apellido"=> $dato,"DNI"=>$user[$indice]["DNI"]];
                $this->setPasajeros($user);
            break;
            case 3: //DNI
                $user[$indice] = ["Nombre"=> $user[$indice]["Nombre"],"Apellido"=> $user[$indice]["Apellido"],"DNI"=>$dato];
                $this->setPasajeros($user);
            break;
        }

    }
}