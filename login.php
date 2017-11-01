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
		<span><a href='layout.html' id="layout" >Inicio</a></span>
		<span><a href='pregunta.php' style="display:none" id="preguntas">Preguntas</a></span>
		<span><a href='creditos.php' id="creditos" >Creditos</a></span>
    <span><a href='verPreguntas.php' id="verPreguntas" style="display:none">Ver preguntas</a></span>
	</nav>
    <section class="main" id="s1">
    
	<div id="formLogin">
        <h1>Iniciar sesion</h1> </br></br>
		<form id='flogin' name='flogin' action="login.php" method='POST'>
		<p>   
			<input type='text' class="Login" id = 'loginEmail' name = 'loginEmail' value="Correo electronico" > </br> </br>  
			<input type='password' class="Login" id = 'loginPassword' name = 'loginPassword' value="Contraseña" > </br>
        </p>
      </br>
			<input type ='submit' class="Login" id="botonlogin" value='Iniciar sesion' class = "boton">
      </br>
      
		</form>
	</div>
        <label id="mensaje" style="font-size: 30px;"></label>
        <label id="error" style="color:red;font-size: 20px;"></label>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
  </div>
</body>
</html>
<script type="text/javascript" src='https://code.jquery.com/jquery-3.2.1.js'></script>
<script>
  
  function logueado(nombre,imagen){
    $('.right').hide();
    $('#layout').hide();
    $('#logout').show();
    $('#verPreguntas').show();
    $('#preguntas').show();
    $('#usuarioMostrar').text("Bienvenido/a " + nombre);
    $('#logueadoImagen').html('<img src="imagenes/'+imagen+'" style="height:60px;width:auto" />');
  }
  
</script>
<?php

if (isset ($_POST['loginEmail'])){
    $usuario =  $_POST['loginEmail'];
    $pass =  $_POST['loginPassword'];
    
    $link = mysqli_connect("localhost","id2920920_amaiajokin","","id2920920_quiz");
    $sql = "select * from usuarios where email = '$usuario' and contrasena='$pass'";
    
    $usuarios = mysqli_query($link,$sql);
    $cont = mysqli_num_rows($usuarios);
    mysqli_close($link);
    
    if ($cont == 1){
        $nombre = mysqli_fetch_array($usuarios);
        $mensaje = "Bienvenido/a ".$nombre['nombre']."!!";
        $nom = $nombre['nombre'];
        $img = $nombre['foto'];
        echo "<script> logueado('$nom','$img'); $('#formLogin').hide(); $('#mensaje').show();</script></br>";
        echo "<script>$('#preguntas').attr('href','pregunta.php?usuario=$usuario'); </script>";
        echo "<script>$('#creditos').attr('href','creditos.php?usuario=$usuario'); </script>";
    }
    else{
      $mensaje = "Usuario o contraseña incorrectos, intentalo de nuevo"; 
    }
    echo "<script>$('#mensaje').text('$mensaje'); </script>";
}


?>