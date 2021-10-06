<?php
require_once (dirname(__FILE__).'/config.php');
require_once(FACHADAS.'FachadaInformacao.php');
require_once(CLASSES.'Usuario.php');
	
    $resultado = FachadaInformacao::getInstancia()->gerenciaReservaDevolucao($_POST["idusuario"], $_POST["codtag"]);

    echo $resultado;
?>