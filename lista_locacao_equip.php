<?php
require_once (dirname(__FILE__).'/config.php');
require_once(FACHADAS.'FachadaInformacao.php');
	        	    		        	    	
    $equipamentos = FachadaInformacao::getInstancia()->listarEquipamentosLocacao($_POST['filtro']);

    echo json_encode($equipamentos);
?>