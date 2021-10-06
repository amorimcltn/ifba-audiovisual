<?php
require_once (dirname(__FILE__).'/config.php');
require_once(FACHADAS.'FachadaInformacao.php');
require_once(CLASSES.'Localizador.php');

	$localizador = new Localizador();		
		
	$localizador->setNomeLocal($_POST['nome_local']);
	$localizador->setDescricao($_POST['descricao']);
    $localizador->setSetorLocal($_POST['setor_local']);        	    
	
    $resultado = FachadaInformacao::getInstancia()->adicionarLocalizador($localizador);

    echo $resultado;
?>