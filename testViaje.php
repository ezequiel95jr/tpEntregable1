<?php
include_once 'viaje.php';
include_once 'Persona.php';
include_once 'Responsable.php';
$arregloDePersonas[0] = new Persona("Ramon","Gonzales","34999999","2995000001");
$arregloDePersonas[1] = new Persona("Julio","Leiva","35999999","2995000002");
$arregloDePersonas[2] = new Persona("Amalia","Flores","39000001","2995000003");
/////////// MENU //////////////
echo "* Cargar informacion del viaje * \n";
    echo "Ingrese el codigo del viaje: ";
    $codigoDelVieje = trim(fgets(STDIN));
    echo "Ingrese el destino: ";
    $destino = validacionLetras();                         //modificado
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
    $responsable1 = new Responsable($nroEmpleado,$nroLicencia,$nombreResposable,$apellidoResponsable);
    $viaje = new Viaje($codigoDelVieje,$destino,$cantMax,$arregloDePersonas,$responsable1);

//un while que controle no pasarse de la cantMax de pasajeros y que cargue uno tras otro de forma ordenada
$stopMenu = true;
$cantPasajeros = count($arregloDePersonas);
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
                    echo "INGRESE LA INFORMACION DEL PASAJERO \n";                                                  //modificado
                    echo "Nombre: ";
                    $name = validacionLetras(); 
                    echo "Apellido: ";                                              
                    $lastName = validacionLetras(); 
                    echo "DNI: ";
                    $dni = validaNumero();
                    echo "Nro de telefono: ";
                    $telefono = validaNumero();
                    // verificación de DNI repetido:
                    if($viaje->buscandoPasajero($dni) != -1){    //es decir, el DNI ingresado fue encontrado en otro pasajero.
                        echo " *** ADVERTENCIA ***\n";
                        echo "El DNI ingresado le pertenece a ".$viaje->muestraDatos($viaje->buscandoPasajero($dni))."\n";
                }                               //el DNI ingresado no se repite.
                    $viaje->cargarPasajero($name,$lastName,$dni,$telefono,($cantPasajeros+1));
                    $cantPasajeros = $cantPasajeros+1;
                    $dniRepetido = false;
                    echo "Pasajero guardado exitosamente.\n";
                    echo "Disponibilidad actual: ".($cantMax - $cantPasajeros)."\n";
                }
            else{   //ya no hay espacio
                echo "Lo sentimos, ya no hay mas espacio para el viaje. Capacida máxima: ".$cantMax."\n";
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
                        echo "a) Nombre \n";
                        echo "b) Apellido \n";
                        echo "c) DNI \n";
                        $opcionModificar = trim(fgets(STDIN));
                        if($opcionModificar == 'a'|| $opcionModificar == 'b'|| $opcionModificar == 'c'){
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