<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class="right"><a href="registrar.php" >Registrarse</a></span>
      		<span class="right"><a href="login.php" >Login</a></span>
          <span class="logueadoDatos" id="logueadoImagen"></span></br></br>
          <span class="logueadoDatos"><label id = "usuarioMostrar"/></span>
      		<span class="right" style="display:none;" id ="logout" ><a href="logout.php">Logout</a></span>
          
          
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html' id="layout">Inicio</a></span>
		<span><a href='pregunta.php' id="preguntas">Preguntas</a></span>
		<span><a href='creditos.php' id="creditos">Creditos</a></span>
    <span><a href='verPreguntas.php' id="verPreguntas">Ver preguntas</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div>
		<form enctype="multipart/form-data" id='fpreguntas' name='fpreguntas' action="pregunta.php" method='POST'>
			<p>Introduce tu correo electr&oacute;nico*:   
			<input type='text' id = 'textoEmail' name = 'textoEmail'> </br>
			Escribe tu pregunta*:   
			<input type='text' id = 'textoPregunta' name = 'textoPregunta'> </br>
			Respuesta correcta*:
			<input type='text' id = 'textoCorrecto' name = 'textoCorrecto'> </br>
			Respuesta incorrecta 1*:
			<input type='text' id = 'textoIncorrecto1' name = 'textoIncorrecto1'> </br>
			Respuestas incorrecta 2*:
			<input type='text' id = 'textoIncorrecto2' name = 'textoIncorrecto2'> </br>
			Respuestas incorrecta 3*:
			<input type='text' id = 'textoIncorrecto3' name = 'textoIncorrecto3'> </br>
			Introduce la complejidad de la pregunta del 1 al 5*:
			<input type='text' id = 'textoComplejidad' name = 'textoComplejidad'> </br>
      Tema de la pregunta*:
			<input type='text' id = 'textoTema' name = 'textoTema'> </br>
      </p>
			<input name="archivos" id="archivos" type="file" size="20" accept="image/*">
      <div id="vista_previa"><!-- miniatura -->Vista previa</div>
      </br> </br>
			<input type ='submit' id="botonenviar" value='Enviar' class = "boton"> <input type='reset' id="botonreset" class = "boton">
      </br></br>
      <div class="error">
        <label id="error" style="color:red;font-size: 50px;"></label>
      </div>
      <label id="mensaje" style="font-size: 50px;"></label>
		</form>
    
    
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
  </div>
  <script type="text/javascript" src='https://code.jquery.com/jquery-3.2.1.js'></script>
  <script type="text/javascript">
	if (window.FileReader) {
      function seleccionArchivo(evt) {
        var files = evt.target.files;
        var f = files[0];
        var leerArchivo = new FileReader();
          leerArchivo.onload = (function(elArchivo) {
            return function(elArchivo) {
              $("#vista_previa").html('<img src="'+ elArchivo.target.result +'" alt="" width="250" />');
            };
          })(f);
    
          leerArchivo.readAsDataURL(f);
      }
     } else {
      $("#vista_previa").html("El navegador no soporta vista previa");
    }
      $("#archivos").on('change', seleccionArchivo);
   
	/*
	function verificar() {
      if(verifEmail()) {
		if(verifComplejidad()) {
          if (verifPregunta()) {
            if(verfiObligatorios()) {
              return true;
            } else {
              return false;
            }
          }else {
            return false;
          }
        } else {
          return false;
        }
      } else {
        return false;
      }
    }
	
	function verifEmail() {
    var email = $('#textoEmail').val();
    var caract = new RegExp(/^([a-z])+(\d{3})+\@((ikasle.ehu)+\.)+(es|eus)+$/);
    if (caract.test(email) == false){
        alert("Email no valido");
        return false;
    }else{
        return true;
    }
	}
  
  function verifPregunta() {
    var preg = $('#textoPregunta').val();
    var num = $.trim(preg).length;
    if (num < 10) {
      alert ("La pregunta debe tener al menos 10 letras");
      return false;
    } else {
      return true;
    }
  }
	
	function verifComplejidad() {
		var compl = $("#textoComplejidad").val();
		if (compl == "") {
			alert("No puedes dejar el campo de complejidad vacio");
			return false;
		} else {
			if (isNaN(compl)) {
				alert ("La compejidad tiene que ser un n&uacute;mero");
				return false;
			} else {
				if(compl % 1 == 0) {
					if (0< compl && compl <6) {
						return true;
					} else {
						alert ("El n&uacute;mero tiene que ser entre 1 y 5");
						return false;
					}
				} else {
					alert("Tu n&uacute;mero en complejidad no es entero");
					return false;
				}
			}
		}
	}
	
	function verfiObligatorios() {
		var correcto = $('#textoCorrecto').val();
		var incorrecto1 = $('#textoIncorrecto1').val();
		var incorrecto2 = $('#textoIncorrecto2').val();
		var incorrecto3 = $('#textoIncorrecto3').val();
    var tema = $('#textoTema').val();
		var vacio1 = (correcto == "");
		var vacio2 = (incorrecto1 == "");
		var vacio3 = (incorrecto2 == "");
		var vacio4 = (incorrecto3 == "");
    var vacio5 = (tema == "");
		if (vacio1 || vacio2 || vacio3 || vacio4 || vacio5) {
			alert("Alguno de los campos obligatorios est&aacute; vacio");
			return false;
		} else {
			return true;
		}
	}*/
	
  function logueado(nombre,imagen){
    $('.right').hide();
    $('#logout').show();
    $('#layout').hide();
    $('#preguntas').show();
    $('#usuarioMostrar').text("Bienvenido/a " + nombre);
    $('#logueadoImagen').html('<img src="imagenes/'+imagen+'" style="height:60px;width:auto" />');
  }
  
  </script>

</body>
</html>

<?php

function logueado(){
  $email = $_GET['usuario'];
  $link = mysqli_connect("localhost","id2920920_amaiajokin","","id2920920_quiz");
  $sql = "select * from usuarios where email = '$email'";
  $resul = mysqli_query($link,$sql);
  $datos = mysqli_fetch_array($resul);
  $nombre = $datos['nombre'];
  $img = $datos['foto'];
  echo "<script> logueado('$nombre','$img'); $('#textoEmail').attr('value','$email'); $('#textoEmail').attr('readonly','readonly');</script>";
  echo "<script> $('#fpreguntas').attr('action','pregunta.php?usuario=$email');</script>";
  echo "<script> $('#preguntas').attr('href','pregunta.php?usuario=$email');</script>";
  echo "<script> $('#creditos').attr('href','creditos.php?usuario=$email');</script>";
  mysqli_close($link);
}
if (isset($_GET['usuario'])){
    logueado();
  }

?>
<!--?php
   if (isset($_POST['textoEmail'])){

    $link = mysqli_connect("localhost","root","root","quiz");
	
	$nombre_img = $_FILES['archivos']['name'];

 
	//Si existe imagen y tiene un tamaño correcto
	if (($nombre_img == !NULL)) 
	{
	   //indicamos los formatos que permitimos subir a nuestro servidor
	   if (($_FILES["archivos"]["type"] == "image/gif")
	   || ($_FILES["archivos"]["type"] == "image/jpeg")
	   || ($_FILES["archivos"]["type"] == "image/jpg")
	   || ($_FILES["archivos"]["type"] == "image/png"))
	   {
		  // Ruta donde se guardarán las imágenes que subamos
		  $directorio = $_SERVER['DOCUMENT_ROOT'].'Lab2BSW/imagenes/';
		  // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
		  move_uploaded_file($_FILES['archivos']['tmp_name'],$directorio.$nombre_img);
		} 
		else 
		{
		   //si no cumple con el formato
		   echo "No se puede subir una imagen con ese formato ";
		}
	}
    
    $sql = "INSERT INTO preguntas VALUES ('','$_POST[textoEmail]','$_POST[textoPregunta]','$_POST[textoCorrecto]','$_POST[textoIncorrecto1]','$_POST[textoIncorrecto2]','$_POST[textoIncorrecto3]','$_POST[textoComplejidad]','$_POST[textoTema]','$nombre_img')";
    if (!mysqli_query($link,$sql)){
        die ("Pulsa en REPETIR para intentarlo de nuevo </br> <input type='button' value = 'REPETIR' onclick='history.back()'>");
		
    }
	echo "Añadida una nueva fila </br>";
    echo "Pulsa aqui para ver todos los datos: ";
    echo '</br>';
    echo '<a href="verPreguntas.php">Ver preguntas</a>';
    echo '</br>';
mysqli_close($link);

    }

    ?> -->

<?php
    if(isset($_POST['textoEmail']))
    {
     $email = ($_POST['textoEmail']);
     $pregunta = trim($_POST['textoPregunta']);
     $correcta = trim($_POST['textoCorrecto']);
     $incorrecta1 = trim($_POST['textoIncorrecto1']);
     $incorrecta2 = trim($_POST['textoIncorrecto2']);
     $incorrecta3 = trim($_POST['textoIncorrecto3']);
     $complejidad = trim($_POST['textoComplejidad']);
     $tema = trim($_POST['textoTema']);
     
     if(empty($email))
     {
      $error = "Email no puede estar vacio";
      $code = 1;
     }
     else if(!preg_match("/^([a-z])+(\d{3})+\@((ikasle.ehu)+\.)+(es|eus)+$/", $email)){
        $error = "El email no cumple el formato especificado";
        $code = 1;
     } else if(strlen($pregunta)<10) {
        $error = "La pregunta tiene que tener como mínimo 10 caracteres";
        $code = 2;
     } else if ($complejidad <1 or $complejidad > 5) {
        $error = "La complejidad tiene que ser un número entero entre 1 y 5";
        $code = 3;
     } else if (empty($correcta) or empty($incorrecta1) or empty($incorrecta2) or empty($incorrecta3) or empty($tema)) {
        $error = "Alguno de los campos obligatorios está vacío";
        $code = 4;      

     }
    
    if (!isset($error)) {

      $link = mysqli_connect("localhost","id2920920_amaiajokin","","id2920920_quiz");
      $nombre_img = $_FILES['archivos']['name'];
      logueado();

 
	//Si existe imagen y tiene un tamaño correcto
	if (($nombre_img == !NULL)) 
	{
	   //indicamos los formatos que permitimos subir a nuestro servidor
	   if (($_FILES["archivos"]["type"] == "image/gif")
	   || ($_FILES["archivos"]["type"] == "image/jpeg")
	   || ($_FILES["archivos"]["type"] == "image/jpg")
	   || ($_FILES["archivos"]["type"] == "image/png"))
	   {
		  // Ruta donde se guardarán las imágenes que subamos
		  $directorio = $_SERVER['DOCUMENT_ROOT'].'/LabSW2Bseg/imagenes/';
		  // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
		  move_uploaded_file($_FILES['archivos']['tmp_name'],$directorio.$nombre_img);
		} 
		else 
		{
		   //si no cumple con el formato
		   echo "No se puede subir una imagen con ese formato ";
		}
	}
  
    
    $sql = "INSERT INTO preguntas VALUES ('','$_POST[textoEmail]','$_POST[textoPregunta]','$_POST[textoCorrecto]','$_POST[textoIncorrecto1]','$_POST[textoIncorrecto2]','$_POST[textoIncorrecto3]','$_POST[textoComplejidad]','$_POST[textoTema]','$nombre_img')";
    if (!mysqli_query($link,$sql)){
        die ("Pulsa en REPETIR para intentarlo de nuevo </br> <input type='button' value = 'REPETIR' onclick='history.back()'>");
		
    }
    $mens="Añadida una nueva pregunta";
    echo "<script> $('#mensaje').text('$mens');</script>";
    mysqli_close($link);
    } else {
          echo "<script> $('#error').text('$error');</script>";
    }
    
    }
    
  ?>
