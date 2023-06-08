
<!DOCTYPE html>
<html>
    <head>
        <title>Analizador de emociones.</title>
        <link rel="stylesheet" href="styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        
    </head>


    <body>




        <!-- Encabezado -->
        <div class="menu-superior">

            <div class="contener-logo">
                <img src="https://comunicacioninstitucional.uabc.mx/sites/default/files/inline-images/escudo-actualizado-2022.png"
                width="67" height="90">
            </div>

            <div class="contener-nombres">
                <h1 class="escuela-nombre" style="font-weight: bold;">Sistema para detectar emociones en los mensajes.</h1>
            </div>
        </div>
        
        <br>
        <br>
        <br>





        <!-- Formulario -->
        <form method="POST"  >
            <center>
                <div class="form-outline w-50 mb-4"">
                        <label for="mensajeTextArea">Introduzca su mensaje:</label>
                        <br>
                        <textarea class="form-control" type="text" value="" id="mensajeTextArea" name="mensajeTextArea" rows="5"></textarea>
                </div>

                <div>
                    <input type="submit" value="Enviar" class="btn btn-outline-secondary" name="btnEnviar">
                </div>
            </center>
        </form>






        <!-- PHP -->
        <?php
            if(isset($_POST['mensajeTextArea']) && !empty($_POST['mensajeTextArea']))
            {

                include("dbUtils.php");

                //Iniciar conexion
                $db = db_open();
                
                //Obtener texto
                $texto = $_POST['mensajeTextArea'];

                //Convertir a minusculas
                $texto = strtolower($texto);

                //Separar en un array y contar los valores
                $texto = preg_split('/[^A-Za-z]/', $texto);
                $textoSize = count($texto);

                //Creamos un Query
                $sql   = "SELECT * FROM palabras";
                $result = mysqli_query($db, $sql);

                
                //Variables
                $totalAnger = 0;
                $totalAnticipation = 0;
                $totalDisgust = 0;
                $totalFear = 0;
                $totalJoy = 0;
                $totalNegative = 0;
                $totalPositive = 0;
                $totalSadness = 0;
                $totalSuprise = 0;
                $totalTrust = 0;


                //Realizamos la consulta
                if (mysqli_num_rows($result) > 0) {
                    
                    for($i = 0; $i < $textoSize; $i++){

                        //Resteamos estas variables
                        $result = mysqli_query($db, $sql);
                        $noRepetir = 0;
                        
                        while($row = mysqli_fetch_array($result)) { 
                            
                            if($row['Spanish_Word'] == $texto[$i] || $row['English_Word'] == $texto[$i]){

                                if(!$noRepetir){
                                    $noRepetir = 1;
                                    echo $i." ";
                                    echo $row['Spanish_Word']." ";
                                    $totalAnger = $totalAnger + $row['anger'];
                                    $totalAnticipation = $totalAnticipation + $row['anticipation'];
                                    $totalDisgust = $totalDisgust + $row['disgust'];
                                    $totalFear = $totalFear + $row['fear'];
                                    $totalJoy = $totalJoy + $row['joy'];
                                    $totalNegative = $totalNegative + $row['negative'];
                                    $totalPositive = $totalPositive + $row['positive'];
                                    $totalSadness = $totalSadness + $row['sadness'];
                                    $totalSuprise = $totalSuprise + $row['surprise'];
                                    $totalTrust = $totalTrust + $row['trust'];
                                }
                            }
                        }
                    }

                    echo "<center>";
                    echo "<br>Ira: $totalAnger";
                    echo "<br>Preucupacion: $totalAnticipation";
                    echo "<br>Disgusto: $totalDisgust";
                    echo "<br>Miedo: $totalFear";
                    echo "<br>Felicidad: $totalJoy";
                    echo "<br>Negatividad: $totalNegative";
                    echo "<br>Positividad: $totalPositive";
                    echo "<br>Tristeza: $totalSadness";
                    echo "<br>Sorpresa: $totalSuprise";
                    echo "<br>Confianza: $totalTrust";
                    echo "</center>";

                } 
            





                //Cerramos la conexion
                db_close($db);
                            
            }


        ?>




    </body>
</html>

