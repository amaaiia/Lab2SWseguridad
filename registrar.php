<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Registrarse</title>
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
		<span><a href='pregunta.php' style="display:none;" id="preguntas">Preguntas</a></span>
		<span><a href='creditos.php' id="creditos">Creditos</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div>
		<form enctype="multipart/form-data" id='fregistrar' name='fregistrar' action="registrar.php" method='POST'>
			<p>Introduce tu correo electr&oacute;nico*:   
			<input type='text' id = 'textoEmail' name = 'textoEmail'> </br>
			Nombre y Apellidos*:   
			<input type='text' id = 'textoNombre' name = 'textoNombre'> </br>
			Nick*:
			<input type='text' id = 'textoNick' name = 'textoNick'> </br>
			Password*:
			<input type='password' id = 'textoContrasena' name = 'textoContrasena'> </br>
			Repetir password*:
			<input type='password' id = 'textoRepContrasena' name = 'textoRepContrasena'> </br>
      </p>
			<input name="archivos" id="archivos" type="file" size="20" accept="image/*">
      <div id="vista_previa"><!-- miniatura -->Vista previa</div>
      </br> </br>
			<input type ='submit' id="botonenviar" value='Enviar' class = "boton"> <input type='reset' id="botonreset" class = "boton">
      </br></br>
      <div class="error">
        <label id="error" style="color:black;font-size: 50px;"></label>
      </div>
		</form>

</body>
</html>
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
  </div>
  <script type="text/javascript" src='https://code.jquery.com/jquery-3.2.1.js'></script>
  <script>
  
  function logueado(nombre,imagen){
    $('.right').hide();
    $('#layout').hide();
    $('#logout').show();
    $('#preguntas').show();
    $('#usuarioMostrar').text("Bienvenido/a " + nombre);
    $('#logueadoImagen').html('<img src="imagenes/'+imagen+'" style="height:60px;width:auto" />');
  }
  
</script>
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
      
  </script>
</html>

<?php
    if(isset($_POST['textoEmail']))
    {
     $email = ($_POST['textoEmail']);
     $nombre = ($_POST['textoNombre']);
     $nick = trim($_POST['textoNick']);
     $contrasena = trim($_POST['textoContrasena']);
     $repContrasena = trim($_POST['textoRepContrasena']);
     
     if(empty($email))
     {
      $error = "Email no puede estar vacio";
      $code = 1;
     } else if(!preg_match("/^([a-z])+(\d{3})+\@((ikasle.ehu)+\.)+(es|eus)+$/", $email)){
        $error = "El email no cumple el formato especificado";
        $code = 1;
     } else if ((mysqli_num_rows(mysqli_query(mysqli_connect("localhost","id2920920_amaiajokin","amaiajokin","id2920920_quiz"),"select * from usuarios where email='$email'"))) == 1) {
        $error = "El email $email ya existe";
        $code = 1;
     } else if(str_word_count($nombre,0)<2) {
        $error = "Debes introducir tu nombre y mínimo un apellido";
        $code = 2;
     } else if (str_word_count($nick,0) != 1) {
        $error = "El nick debe estar formado solo por una palabra";
        $code = 3;
     } else if (strlen($contrasena) <6) {
        $error = "La contraseña debe contener al menos 6 caracteres";
        $code = 4;
     } else if ($contrasena != $repContrasena) {
        $error = "No has introducido la misma contraseña al repetirla";
        $code = 5;
     }
     
    
    
    if (!isset($error)) {
      $link = mysqli_connect("localhost","id2920920_amaiajokin","","id2920920_quiz");
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
    
    $sql = "INSERT INTO usuarios VALUES ('$_POST[textoEmail]','$_POST[textoNombre]','$_POST[textoNick]','$_POST[textoContrasena]','$nombre_img')";
    if (!mysqli_query($link,$sql)){
        die ("Pulsa en REPETIR para intentarlo de nuevo </br> <input type='button' value = 'REPETIR' onclick='history.back()'>");
		
    }
    $email = $_POST['textoEmail'];
    echo "<script> window.location.href = 'pregunta.php?usuario=$email';</script>";
  	echo "Añadido nuevo usuario </br>";
    mysqli_close($link);
    } else {
      echo "<script> $('#error').text('$error');</script>";
    }
    }
      
?>
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
  echo "<script> $('#fpreguntas').attr('action','pregunta.php?usuario=$email'); </script>";
  echo "<script> $('#preguntas').attr('href','pregunta.php?usuario=$email'); </script>";
  echo "<script> $('#creditos').attr('href','creditos.php?usuario=$email'); </script>";
  mysqli_close($link);
}
if (isset($_GET['usuario'])){
    logueado();
  }

?>