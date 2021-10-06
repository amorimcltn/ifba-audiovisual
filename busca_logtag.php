<?php
require_once (dirname(__FILE__).'/config.php');
require_once(FACHADAS.'FachadaInformacao.php');
	
    $resultado = FachadaInformacao::getInstancia()->buscaRastreabilidade($_POST["idequipamento"]);

    echo json_encode($resultado);
?>