
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombre"])&& isset($_POST["edad"])&& isset($_POST["descripcion"])){
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : "";
        $edad = isset($_POST["edad"]) ? $_POST["edad"] : "";
        $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : "";
        // guardamos los datos en una array
        function guardar_array($nombre,$apellido,$edad,$descripcion){
            $array = [
                "nombre" => $nombre,
                "apellido" => $apellido,
                "edad" => $edad,
                "descripcion" => $descripcion
            ];
            return $array;
        }
        //Creamos los archivos separando la información del array
        function guardar_archivos($array){

            //guardar en un txt 
            if($array['edad'] !== ""){
                $fileEdades = fopen("archivos/edades_participantes.txt", "a");

                fwrite($fileEdades, "{$array['edad']}\n");
                fclose($fileEdades);
            }else{
                //echo "La edad esta vacia";
            }
            if($array['nombre'] !== "" && $array['descripcion']!== "" && $array['apellido']!== ""){
                $fileInfoParticipantes = fopen("archivos/info_participantes.txt", "a");

                fwrite($fileInfoParticipantes, "{$array['nombre']} {$array['apellido']}\n{$array['descripcion']}\n");
                fclose($fileInfoParticipantes);
            }else{
                //echo "O el nombre o la descripción estan vacios";
            }
            //crear un json con la info de los participantes 
            if(file_exists("archivos/edades_participantes.txt")){
                $archivo_txt = "archivos/info_participantes.txt";
                //archivo json
                $archivo_json = "archivos/info_participantes.json";

                //leer el archivo de texto
                $texto = file($archivo_txt, FILE_SKIP_EMPTY_LINES );

                //guardar los participantes
                $participantes = [];

                for($i =0;$i<count($texto); $i+=2){
                    $nombreParticipante =trim($texto[$i]); 
                    $desParticipante =trim($texto[$i+1]);

                    $participante = [
                        "nombre"=> $nombreParticipante,
                        "descripcion" => $desParticipante
                    ];
                    $participantes[]=$participante;
                }

                //lo convertimos en json
                $json = json_encode($participantes, JSON_PRETTY_PRINT);

                file_put_contents($archivo_json,$json);
            }
            
        }
        if($_POST["nombre"] != "" && $_POST["apellido"]!="" && $_POST["edad"]!="" && $_POST["descripcion"]!=""){
            $arrayDatos = guardar_array($nombre,$apellido,$edad,$descripcion);
            guardar_archivos($arrayDatos);
            //echo "Archivos creados";
        }

    }else {
        //echo "Hay algún elemento que esta vacio";
    }
    if(file_exists("archivos/edades_participantes.txt")){
        //leemos el contenido del archivo de las edades y lo guardamos en un array para obtener la media 
        $edades = file("archivos/edades_participantes.txt",FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        //lo convertimos en array de enteros para poder manejarlos
        $edades_enteros = array_map('intval', $edades);
        
        //reiniciamos las variables
        $suma_edades=0;
        $contador=0;
        $menor_edad =!empty($edades_enteros) ? min($edades_enteros) : 0;
        $mayor_edad =!empty($edades_enteros) ? max($edades_enteros) : 0;
        $hasta_25 = 0;
        $entre_25_50 = 0;
        $desde_50 = 0;

        //recorremos el array para sumar las edades y contar cuantas hay
        for($i=0;$i<count($edades_enteros);$i++){

            if($edades_enteros[$i]>$mayor_edad){
                $mayor_edad = $edades_enteros[$i];
            }
            if($edades_enteros[$i]<$menor_edad){
                $menor_edad = $edades_enteros[$i];
            }
            if($edades_enteros[$i]<25){
                $hasta_25++;
            }
            if($edades_enteros[$i]>25 && $edades_enteros[$i]<50){
                $entre_25_50++;
            }
            if($edades_enteros[$i]>50){
                $desde_50++;
            }
            $suma_edades += $edades_enteros[$i];
            $contador++;
        }
        
        if($contador>0){
            //porcentaje de participantes según edades 
            $porcentaje_hasta_25 = ($hasta_25 / $contador) * 100;
            $porcentaje_entre_25_50 = ($entre_25_50 / $contador) * 100;
            $porcentaje_desde_50 = ($desde_50 / $contador) * 100;

            //calculamos la media y la guardamos en la variable 
            $media_edades = $suma_edades / $contador;

        }else{
            $porcentaje_hasta_25 = 0;
            $porcentaje_entre_25_50 = 0;
            $porcentaje_desde_50 = 0;

            $media_edades=0;
        }

    }else{
        //echo "El archivo de las edades no existe";

    }
    if(file_exists("archivos/info_participantes.json")){

        //leo el contenido del Json
        $json_contenido = file_get_contents("archivos/info_participantes.json");

        //lo convierto en un array
        $infoParticipantes = json_decode($json_contenido, true);
    }
    ?>