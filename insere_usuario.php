<?php
require_once (dirname(__FILE__).'/config.php');
require_once(FACHADAS.'FachadaInformacao.php');
require_once(CLASSES.'Usuario.php');

	$usuario = new Usuario();		
		
	$usuario->setNomeUsuario($_POST['nome']);
	$usuario->setTipoUsuario($_POST['tipo_usuario']);
	$usuario->setEmailUsuario($_POST['login']);
	$usuario->setSenhaUsuario($_POST['password']);    
	
    $resultado = FachadaInformacao::getInstancia()->adicionarUsuario($usuario);

    echo $resultado;
?>