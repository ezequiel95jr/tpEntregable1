<?php
include_once 'viaje.php';
include_once 'Pasajero.php';
include_once 'PasajeroVip.php';
include_once 'PasajeroEsp.php';
include_once 'PasajeroEstandar.php';
include_once 'Responsable.php';
$arregloDePasajero[0] = new PasajeroEstandar("Ramon","Gonzales","34999999","2995000001","45","156");    //estandar  agregar modificaciones y modificar el arreglo para que sea uno solo para los 3 tipos de clases
$arregloDePasajero[1] = new PasajeroVip("Julio","Leiva","35999999","2995000002","14","189","14988",459);       //vip 
$arregloDePasajero[2] = new PasajeroEsp("Amalia","Flores","39000001","2995000003","19","763",true,true,true);     //NE 
/////////// MENU //////////////
echo "* Cargar informacion del viaje * \n";
            echo "Ingrese el codigo del viaje: ";
            $codigoDelVieje = trim(fgets(STDIN));
            echo "Ingrese el destino: ";
            $destino = validacionLetras();                         
            echo "Ingrese el precio del viaje: $";
            $precio = validaNumero();
            echo "Ingrese la cantidad máxima de pasajeros: ";
            $cantMax = validaNumero();
            echo "\n";
            echo "Cargue los datos del responsable del viaje: \n";
             /* el número de empleado, número de licencia, nombre y apellido */
            echo "Número de empleado: ";
            $nroEmpleado = validaNumero();
            echo "Nombre: ";
            $nombreResposable = validacionLetras();
            echo "Apellido: ";
            $apellidoResponsable = validacionLetras();
            echo "Numero de licencia: ";
            $nroLicencia = validaNumero();
            $sumaCosto = 0;
            $responsable1 = new Responsable($nroEmpleado,$nroLicencia,$nombreResposable,$apellidoResponsable);
            $viaje = new Viaje($codigoDelVieje,$destino,$precio,$sumaCosto,$cantMax,$arregloDePasajero,$responsable1);

//un while que controle no pasarse de la cantMax de pasajeros y que cargue uno tras otro de forma ordenada
$stopMenu = true;
$cantPasajeros = count($arregloDePasajero);
do{
    echo "          MENÚ \n";            
    echo "1) Ingresar un nuevo pasajero: \n";
    echo "2) Modificar datos de un pasajero: \n";
    echo "3) Modificar informacion del viaje: \n";
    echo "4) Ver datos del viaje \n";
    echo "5) Exit. \n";
    echo "ingrese la opcion elegida: ";
    $opcion = trim(fgets(STDIN));
    if($opcion < 6 && $opcion > 0){     //validacion opcion 1    
    switch($opcion){
        case 1: //////////// CARGAR UN NUEVO PASAJERO /////////////
            $dniRepetido = true;  
            if($viaje->hayPasajesDisponible()){   //hay espacio
                    echo "INGRESE LA INFORMACION DEL PASAJERO \n";                                               
                    echo "Nombre: ";
                    $name = validacionLetras(); 
                    echo "Apellido: ";                                              
                    $lastName = validacionLetras(); 
                    echo "Nro de asiento: ";
                    $nroAsiento = validaNumero();
                    echo "Nro de ticket: ";
                    $nroTicket = validaNumero();
                    echo "Nro de telefono: ";
                    $telefono  = validaNumero();
                    echo "DNI: ";
                    $dni = validaNumero();
                    // verificación de DNI repetido:
                    if($viaje->buscandoPasajero($dni) != -1){    //es decir, el DNI ingresado fue encontrado en otro pasajero.
                        echo " *** ADVERTENCIA ***\n";
                        echo "El DNI ingresado le pertenece a ".$viaje->muestraDatos($viaje->buscandoPasajero($dni))."\n";
                }                               //el DNI ingresado no se repite.
                    echo "Ingrese el tipo de pasajero (vip, estandar, especial): ";
                    $tipoPasajero = validacionLetras();
                    $newObj = varificaPasajero($tipoPasajero,$name,$lastName,$nroAsiento,$nroTicket,$dni,$telefono);
                    $viaje->venderPasaje($newObj);
                    //$viaje->cargarPasajero($newObj);
                    $dniRepetido = false;
                    echo "Pasajero guardado exitosamente.\n";
                    echo "Disponibilidad actual: ".($cantMax - $cantPasajeros)."\n";
                    $cantPasajeros = $cantPasajeros + 1;
                }
            else{   //ya no hay espacio
                echo "Lo sentimos, ya no hay mas espacio para el viaje. Capacida max: ".$cantMax."\n";
            } 
            break;
        case 2: //////////// MODIFICAR LOS DATOS DE UN PASAJERO /////////////////
            if($cantPasajeros == 0){
                echo "Lo sentimos, no hay pasajeros cargados.\n";
            }
            else{
                echo "ingrese el dni del pasajero al que quiere modificar: ";
                $dniBuscado = trim(fgets(STDIN));
                $posicion = $viaje->buscandoPasajero($dniBuscado);
                //devuelve -1 si no lo encuenta, devuelve la posicion si el pasajero existe
                if($posicion == -1){   //// busca el dni dentro del array pasajeros
                    //no encontró al pasajero
                    echo "Lo sentimos, el pasajero que busca no existe.\n";
            }
                else{
                    
                    // pasajero encontrado
                    // MODIFICA DATOS //
                    // condicion que verifique si la cant de pasajeros es 0 y mensaje que advierta 
                    echo "Pasajero encontrado: ".$viaje->muestraDatos($posicion)."\n";
                    echo "Qué dato desea modificar? \n";
                    $opValida = true;
                    do{
                        if( $viaje->getPasajeros()[$posicion] instanceof PasajeroVip ){
                            echo "a) Nombre \n";
                            echo "b) Apellido \n";
                            echo "c) DNI \n";
                            echo "d) Cantidad de millas\n";
                            echo "e) Número de viajero frecuente\n";
                        }
                        elseif($viaje->getPasajeros()[$posicion] instanceof PasajeroEstandar){
                            //modifica estandar
                            echo "a) Nombre \n";
                            echo "b) Apellido \n";
                            echo "c) DNI \n";
                        }
                        elseif($viaje->getPasajeros()[$posicion] instanceof PasajeroEsp){
                            //modifica esp
                            echo "a) Nombre \n";
                            echo "b) Apellido \n";
                            echo "c) DNI \n";
                            echo "AGREGAR: \n";
                            echo "1) silla de rueda\n";
                            echo "2) Comida diferenciada \n";
                            echo "3) Asistencia \n";
                        }
                        
                        $opcionModificar = trim(fgets(STDIN));
                        if($opcionModificar == 'a'|| $opcionModificar == 'b'|| $opcionModificar == 'c' || $opcionModificar == 'd' || $opcionModificar == 'e' || $opcionModificar == '1' || $opcionModificar == '2' || $opcionModificar == '3'){
                            switch($opcionModificar){
                                case "a":    
                                    $id = 1;                    
                                    echo "Nuevo nombre: ";                                  
                                    $name = validacionLetras(); 
                                    $viaje->modificaPasajero($name,$posicion,$id);
                                break;
                                case "b":
                                    $id = 2;
                                    echo "Nuevo apellido: ";
                                    $lastName = validacionLetras();
                                    $viaje->modificaPasajero($lastName,$posicion,$id);
                                break;
                                case "c":
                                    $id = 3;
                                    echo "Nuevo DNI: ";
                                    $dni = validaNumero();
                                    if($viaje->buscandoPasajero($dni) != -1){    //es decir, el DNI ingresado fue encontrado en otro pasajero.
                                        echo " *** ADVERTENCIA ***\n";
                                        echo "El DNI ingresado le pertenece a ".$viaje->muestraDatos($posicion)."\n";
                                        echo "vuelva a intentarlo \n";
                            }       else{
                                        $viaje->modificaPasajero($dni,$posicion,$id);
                            }
                                break; 
                                case 'd':
                                    $millas = $viaje->getPasajeros()[$posicion]->getMillas();
                                    $id = 4;
                                    echo "ingrese las nuevas millas: ";
                                    $millas1 = validaNumero();
                                    $millas1 = $millas + $millas1;
                                    $viaje->modificaPasajero($millas1, $posicion,$id);
                                    break;        
                                case 'e':
                                    $id = 5;
                                    echo "nro de viajero frecuente: ";
                                    $nroFrecuente = validaNumero();
                                    $viaje->modificaPasajero($nroFrecuente,$posicion,$id);
                                break;
                                case '1':
                                    $id = 6;
                                    $valorSilla = false;
                                    echo "agregar silla de ruedas: (si/no)";
                                    $sillaRueda = validacionLetras();
                                    if($sillaRueda == "si"){
                                        $valorSilla = true;
                                    }
                                    $viaje->modificaPasajero($valorSilla,$posicion,$id);
                                    break;
                                case '2':
                                    $id = 7;
                                    $valorComida = false;
                                    echo "comida diferente? (si/no): ";
                                    $comidaEspecial = validacionLetras();
                                    if($comidaEspecial == "si"){
                                        $valorComida = true;
                                    }
                                    $viaje->modificaPasajero($valorComida,$posicion,$id);
                                    break;
                                case '3':
                                    $id = 8;
                                    $valorAsistencia = false;
                                    echo "asistencia (si/no): ";
                                    $asistencia = validacionLetras();
                                    if($asistencia == "si"){
                                        $valorAsistencia = true;
                                    }
                                    $viaje->modificaPasajero($valorAsistencia,$posicion,$id);
                                    break;
                            }
                            $opValida = false;
                        }
                        else{
                            echo "Opcion invalida, try again. \n";
                        }
                    }
                    while($opValida);
                    

                }
            }
        break;
        case 3:///////////// MODIFICA DATOS DEL VIAJE ///////////////////
                do{
                $opcionCorrecta = true;
                echo "qué dato desea modificar? \n";
                echo "a) codigo del viaje.\n";
                echo "b) destino.\n";     
                echo "c) cantidad de pasajeros.\n";
                $opcionViajeModificado = trim(fgets(STDIN));
                // VALIDACION DE OPCION INGRESADA //
                if($opcionViajeModificado == "a" || $opcionViajeModificado == "b" || $opcionViajeModificado == "c"){
                $opcionCorrecta = false;
                switch($opcionViajeModificado){
                        case "a":
                            $idModificator = 1;
                            echo "nuevo codigo: ";
                            $modificacion = trim(fgets(STDIN));
                        break;
                        case "b":
                            $idModificator = 2;
                            echo "nuevo destino: ";
                            $modificacion = validacionLetras();
                            $viaje->modificator($modificacion,$idModificator);
                        break;
                        case "c": 
                            $idModificator = 3;
                        do{     ///// validacion de numero //////
                            echo "nueva cantidad de pasajeros: ";
                            $modificacion = trim(fgets(STDIN));
                            $opcionValida = false;
                            if(is_numeric($modificacion) == true){
                                $opcionValida = true;
                            }
                            else{
                                echo "el carácter ingresado es invalido. \n";
                            }
    }
            while($opcionValida == false);
        break;     
    }
                $viaje->modificator($modificacion,$idModificator);
}
                else{
                        echo "Opcion invalida.\n";
    }}
        while($opcionCorrecta == true);  
        break;
        case 4: //////////// SHOW DATOS ////////////////////
            if($cantPasajeros == 0){
                echo "NO HAY PASAJEROS CARGADOS \n";
            }
            else{
                echo "------------------------------- \n";
                echo $viaje->__toString();
            }
        break;
        case 5: 
            $stopMenu = false;
    }
}
        else{
            echo "** opcion inválida ** \n";
        }
        }while($stopMenu == true);

        function validacionLetras(){
            $valor = true;
            do{               
                        $dato = trim(fgets(STDIN));
                        if(is_numeric($dato)){
                            echo "Ingrese el dato correctamente: (sin numeros): ";    
                        }
                        else{
                            $valor = false;
                        } 
        }while($valor == true);
        return $dato;
}

    function varificaPasajero($tipoP,$nom,$lastNom,$numAsiento,$numTicket,$doc,$tel){
        switch($tipoP){
            case "vip": 
                echo "ingrese: \n";
                echo "número de pasajero frecuente: ";
                $nroFrecuente = validaNumero();
                echo "cantidad de millas acumuladas: ";
                $millas = validaNumero();
                $objPasajeroNuevo = new PasajeroVip($nom,$lastNom,$numAsiento,$numTicket,$doc,$tel,$nroFrecuente,$millas);
                break;
            case "estandar":
                $objPasajeroNuevo = new PasajeroEstandar($nom,$lastNom,$numAsiento,$numTicket, $doc, $tel);
                break;
            case "especial";
                $valorSilla = false;
                $valorComida = false;
                $valorAsistencia = false;
                echo "Ingrese las necesidades que solicita: \n";
                echo "silla de ruedas?(si/no)";
                $sillaRueda = validacionLetras();
                if($sillaRueda == "si"){
                    $valorSilla = true;
                }
                echo "comida diferente? (si/no)";
                $comidaEspecial = validacionLetras();
                if($comidaEspecial == "si"){
                    $valorComida = true;
                }
                echo "asistencia (si/no): ";
                $asistencia = validacionLetras();
                if($asistencia == "si"){
                    $valorAsistencia = true;
                }
                $objPasajeroNuevo = new PasajeroEsp($nom,$lastNom,$numAsiento,$numTicket, $doc, $tel,$valorSilla,$valorComida,$valorAsistencia);
            break; 
            return $objPasajeroNuevo;       
    }
}  
    function validaNumero(){

        $nroValido = false;
        do{
            $num = trim(fgets(STDIN));
            if(is_numeric($num) == true){
                $nroValido = true;    
    }
        else{
                echo "el dato ingresado no es valido. Vuelva a intentarlo: ";
    }        
        }while($nroValido == false); 
    return $num;                     
}