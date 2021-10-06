<?php
require_once (dirname ( __FILE__ ) . '/config.php');
require_once (FACHADAS . 'FachadaInformacao.php');
require_once (CLASSES . 'Usuario.php');

$usuario = $_POST ['usuario'];
$senha = $_POST ['senha'];
$usuario_scape = addslashes($usuario);
$senha_scape = addslashes($senha);
$usuarios = FachadaInformacao::getInstancia ()->autenticarUsuario ( $usuario_scape, $senha_scape );

if ($usuarios != null) {
    session_start ();
    $_SESSION ['idusuario'] = $usuarios[0]->getIdUsuario();
    $_SESSION ['nome'] = $usuarios[0]->getNomeUsuario();
    $_SESSION ['tipo_usuario'] = $usuarios[0]->getTipoUsuario();
    echo "1";
} else {
	echo "0";
}

?>
