<?php
require_once (dirname(__FILE__).'/config.php');
require_once(FACHADAS.'FachadaInformacao.php');
	        	    		        	    	
    $localizadores = FachadaInformacao::getInstancia()->listarLocalizadores($_POST['filtro']);

    echo json_encode($localizadores);
?>