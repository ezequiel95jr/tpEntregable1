<?php
Class Viaje{
    private $codViaje;
    private $destino;
    private $precio;
    private $sumaCostos;
    private $cantMax;
    private $pasajeros;                 // coleccion de obj persona
    private $responsable;               // obj responsable
    //////////// METODOS DE ACCESO ////////////////
    public function __construct($codigo,$dest,$precio1,$suma,$cant,$pasajeros,$pResponsable){
        $this->codViaje = $codigo;
        $this->destino = $dest;
        $this->precio = $precio1;
        $this->sumaCostos = $suma;
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
    public function getPrecio(){
        return $this->precio;
    }
    public function getSumaCostos(){
        return $this->sumaCostos;
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
    public function setPrecio($p){
        $this->precio = $p;
    }
    public function setCostos($costo){
        $this->sumaCostos = $costo;
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
        return "Codigo del vieje: ".$this->getCodViaje().", Destino: ".$this->getDestino()." | Suma de costos: $".$this->getSumaCostos().", Cantidad maxima: ".$this->getcantMax()."\n". $cadenaPasajeros."Responsable: ".$this->getResponsable()->__toString();
    }
    public function showPasajeros1(){
        $cadena = "";
        $ArrayPasajeros = $this->getPasajeros();    //array de obj pasajeros
        for($i=0;$i<count($ArrayPasajeros);$i++){
            $cadena = $cadena. "\n Pasajero nro ".($i+1)."\n" ." | Precio: $".$this->venderPasaje($ArrayPasajeros[$i])."  ". $ArrayPasajeros[$i]->__toString()."\n";
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
            break;          
        }
    } 

    public function buscandoPasajero($dni){
        $i=0;
        $found = false;
        $posicionPasajero = -1;
        while($i<count($this->getPasajeros()) && !$found){
            if( $dni == $this->getPasajeros()[$i]->getDNI() ){
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
        return $this->getPasajeros()[$i]->getName()." ".$this->getPasajeros()[$i]->getApellido()." | número de asiento: ".$this->getPasajeros()[$i]->getNroAsiento()."   | número de ticket: ".$this->getPasajeros()[$i]->getNroTicket()."\n";
    }
    
    public function cargaDatosViaje($pCodigo,$pDestino,$pCantMax){
        //carga los datos del viaje
        $this-> setCodigo($pCodigo);
        $this-> setDestino($pDestino);
        $this-> setCantMax($pCantMax);
    }
    public function cargarPasajero($objPasajeroNew){
        $arrayPa = $this->getPasajeros();
        array_push($arrayPa,$objPasajeroNew);
        $this->setPasajeros($arrayPa);
    }
    public function modificaPasajero($dato, $indice, $id){
        $arrayPasajeros = $this->getPasajeros();
        switch($id){
            case 1: //nombre
                $arrayPasajeros[$indice]->setNombre($dato);
            break;
            case 2: // apellido          
                $arrayPasajeros[$indice]->setApellido($dato);
            break;
            case 3: //DNI       
                $arrayPasajeros[$indice]->setDNI($dato);              
            break;
            case 4: // pasajero vip: millas
                $arrayPasajeros[$indice]->setMillas($dato);
            break;
            case 5: // pasajero vip: nro viajero frecuente
                $arrayPasajeros[$indice]->setNroFrecuente($dato);   
            break;
            case 6: // pasajero NE: silla de rueda
                $arrayPasajeros[$indice]->setSillaDeRueda($dato);
            break;
            case 7: // pasajero NE: comida especial
                $arrayPasajeros[$indice]->setComidaEspecial($dato);
                break;
            case 8: // pasajero NE: asistencia
                $arrayPasajeros[$indice]->setAsistencia($dato);
                break;         
        }
        $this->setPasajeros($arrayPasajeros);
    }

    public function venderPasaje($objPasajero){

        $this->cargarPasajero($objPasajero);
        $porcentajeActual = $objPasajero->darPorcentajeIncremento();
        $precioActual = $this->getPrecio();
        $precioActual = $precioActual + (($precioActual * $porcentajeActual)/100);
        $sumaC = $this->getSumaCostos();
        $sumaC = $sumaC + $precioActual;
        $this->setCostos($sumaC);
        
    }

    public function  hayPasajesDisponible() {
        //retorna verdadero si la cantidad de pasajeros del viaje es menor a la cantidad máxima de pasajeros y falso caso contrario
        $p = $this->getPasajeros();
        $espacio = false;
        if( count($p) <= $this->getCantMax() ){
            $espacio = true;
        }
        return $espacio;
    }
}