<?php
Class PasajeroEstandar extends Pasajero{


    public function __construct($n,$ap,$doc,$tel,$nroA,$nroT){
        parent:: __construct($n,$ap,$doc,$tel,$nroA,$nroT);
    }

    public function darPorcentajeIncremento(){
        $newPorcentaje = parent::darPorcentajeIncremento();
        $newPorcentaje = $newPorcentaje + 10;
    }
}