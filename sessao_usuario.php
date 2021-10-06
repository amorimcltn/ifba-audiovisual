<?php   
	session_start(); 
	if(!isset ($_SESSION['nome'])) { 
		unset($_SESSION['idusuario']); 
		unset($_SESSION['nome']);
        unset($_SESSION['tipo_usuario']); 
		header("location: index.html"); 
	} 

    echo $_SESSION["idusuario"];
?>