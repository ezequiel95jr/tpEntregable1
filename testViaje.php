<?php
include 'viaje.php';
$usuarios = [];
$viaje = new Viaje("0","default","0",$usuarios);
/////////// MENU //////////////
echo "Cargar informacion del viaje: \n";
            echo "Ingrese el codigo del viaje: ";
            $codigoDelVieje = trim(fgets(STDIN));
            $viaje->setCodigo($codigoDelVieje);
            // dato: destino, id = 1;
            $idDestino = 1;
            validacionLetras($idDestino);
            $opcionValida = false;
            do{     ///// validacion de numero //////
                echo "Ingrese la cantidad máxima de pasajeros: ";
                $cantMax = trim(fgets(STDIN));
                if(is_numeric($cantMax) == true){
                    $opcionValida = true;
                    $viaje->setCantMax($cantMax);
                }
                else{
                    echo "el carácter ingresado es invalido. \n";
                }

            }
            while($opcionValida == false);

            echo "\n";
            //cargaDatos($codigoDelVieje,$destino,$cantMax);

//un while que controle no pasarse de la cantMax de pasajeros y que cargue uno tras otro de forma ordenada
$stopMenu = true;
$cantPasajeros = 0;
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
            if($cantPasajeros<$cantMax){   //hay espacio
                    echo "INGRESE LA INFORMACION DEL PASAJERO \n";
                    // nombre, id del validador de datos = 2.
                    $idNombre = 2;
                    validacionLetras($idNombre);
                    echo "Nombre: ";
                    $name = trim(fgets(STDIN));
                    echo "Apellido: ";
                    $lastName = trim(fgets(STDIN));
                do{
                    echo "DNI: ";
                    $dni = trim(fgets(STDIN));
                    // verificación de DNI repetido:
                    if($viaje->buscandoPasajero($dni) != -1){    //es decir, el DNI ingresado fue encontrado en otro pasajero.
                        echo " *** ADVERTENCIA ***\n";
                        echo "El DNI ingresado le pertenece a ".$viaje->muestraDatos($viaje->buscandoPasajero($dni))."\n";

                    }
                    elseif(is_numeric($dni) != true){
                        echo "no está ingresando numeros, vuelva a intentarlo \n";

                    }
                    else{                               //el DNI ingresado no se repite.
                    $usuarios[$cantPasajeros] = ["Nombre"=>$name,"Apellido"=>$lastName,"DNI"=>$dni];
                    $cantPasajeros = $cantPasajeros+1;
                    $viaje->setPasajeros($usuarios);
                    $dniRepetido = false;
                    echo "Pasajero guardado exitosamente.\n";
            }}  while($dniRepetido == true);
                }
            else{   //ya no hay espacio
                echo "Lo sentimos, ya no hay mas espacio para el viaje. Capacida máxima: ".$cantMax."\n";
            } 
            break;
        case 2: //////////// MODIFICAR LOS DATOS DE UN PASAJERO /////////////////
            if($cantPasajeros == 0){
                echo "Lo sentimos, no hay pasajeros cargados.";
            }
            else{
                echo "ingrese el dni del pasajero al que quiere modificar: ";
                $dniBuscado = trim(fgets(STDIN));
                $posicion = $viaje->buscandoPasajero($dniBuscado);
                //devuelve -1 si no lo encuenta, devuelve la posicion si el pasajero existe
                if($posicion == -1){   //// busca el dni dentro del array pasajeros
                    //no encontró al pasajero
                    echo "Lo sentimos, el pasajero que busca no existe.";
            }
                else{
                    // pasajero encontrado
                    // MODIFICA DATOS //
                    // condicion que verifique si la cant de pasajeros es 0 y mensaje que advierta 
                    echo "Pasajero encontrado: ".$viaje->muestraDatos($posicion)."\n";
                    echo "Qué dato desea modificar? \n";
                    echo "a) Nombre \n";
                    echo "b) Apellido \n";
                    echo "c) DNI \n";
                    $opcionModificar = trim(fgets(STDIN));
                    switch($opcionModificar){
                        case "a":    
                            $id = 1;                    
                            echo "Nuevo nombre: ";
                            $name = trim(fgets(STDIN));
                        break;
                        case "b":
                            $id = 2;
                            echo "Nuevo apellido: ";
                            $lastName = trim(fgets(STDIN));
                        break;
                        case "c":
                            $id = 3;
                            $dniValido = false;
                            do{
                                echo "DNI: ";
                                $dni = trim(fgets(STDIN));
                                if(is_numeric($dni) == true){
                                    if($viaje->buscandoPasajero($dni) != -1){    //es decir, el DNI ingresado fue encontrado en otro pasajero.
                                        echo " *** ADVERTENCIA ***\n";
                                        echo "El DNI ingresado le pertenece a ".$viaje->muestraDatos($viaje->buscandoPasajero($dni))."\n";
                                        echo "vuelva a intentarlo \n";
                                    }
                                    else{
                                        $dniValido = true;
                                    }
                                }
                                else{
                                    echo "el DNI ingresado no es valido. Vuelva a intentarlo \n";
                                }
                            }while($dniValido == false);
                        break;         
                    }
                    $usuarios[$posicion] = ["Nombre"=>$name,"Apellido"=>$lastName,"DNI"=>$dni];
                    $viaje->setPasajeros($usuarios);
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
                            $codigoDelVieje = trim(fgets(STDIN));
                            $viaje->modificator($codigoDelVieje,$idModificator);
                        break;
                        case "b":
                            $idModificator = 2;
                            echo "nuevo destino: ";
                            $destino = trim(fgets(STDIN));
                            $viaje->modificator($destino,$idModificator);
                        break;
                        case "c": 
                            $idModificator = 3;
                            echo "nueva cantidad de pasajeros: ";
                            $cantMax = trim(fgets(STDIN));
                            $opcionValida = false;
                        do{     ///// validacion de numero //////
                            echo "Ingrese la cantidad máxima de pasajeros: ";
                            $cantMax = trim(fgets(STDIN));
                            if(is_numeric($cantMax) == true){
                                $opcionValida = true;
                                $viaje->setCantMax($cantMax);
                            }
                            else{
                                echo "el carácter ingresado es invalido. \n";
                            }
    }
            while($opcionValida == false);
        break;     
    }}
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
function validacionLetras($idDato){
    $valor = true;
    do{
                echo "Ingrese el destino: ";
                $dato = trim(fgets(STDIN));
                if(!is_numeric($dato)){
                    $viaje->setDestino($destino);
                }
                else{
                    echo "el dato ingresado no es valido.";
            

                 } 
}while($valor == true);
}