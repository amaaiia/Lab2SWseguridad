
		<?php
    $link = mysqli_connect("localhost","id2920920_amaiajokin","","id2920920_quiz");
    $datos = mysqli_query($link,"select * from preguntas");
    echo '<table border=1 style = "width:auto" > <tr> <th> NUMERO_PREGUNTA </th> <th> EMAIL  </th> <th> PREGUNTA </th> <th> RESPUESTA CORRECTA  </th>  <th> INCORRECTA1  </th> <th> INCORRECTA2  </th> <th> INCORRECTA3  </th> <th> COMPLEJIDAD  </th> <th> TEMA  </th> <th> IMAGEN  </th> </tr>';
    while ($row = mysqli_fetch_array($datos)){
        echo '<tr><td style="height:200px;">'.$row['numPregunta'].'</td><td>'.$row['email'].'</td><td>'.$row['pregunta'].'</td><td>'.$row['correcta'].'</td><td>'.$row['incorrecta1'].'</td><td>'.$row['incorrecta2'].'</td><td>'.$row['incorrecta3'].'</td><td>'.$row['complejidad'].'</td><td>'.$row['tema'].'</td><td style="height:200px;">'.'<img height="100%" src ="imagenes/'.$row['imagen'].'"/>'.'</td></tr>';
    }
    echo  '</table>';
    $datos -> close();
    mysqli_close($link);
?>