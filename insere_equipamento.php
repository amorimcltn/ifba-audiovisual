<?php
require_once (dirname(__FILE__).'/config.php');
require_once(FACHADAS.'FachadaInformacao.php');
require_once(CLASSES.'TagEquipamento.php');

    function formataDate($data){
        $strdate = "";
        for ($x = 0; $x < strlen($data); $x++){
            if ($data[$x] == '/'){
                $strdate = $strdate."-";
            }else{
                $strdate = $strdate.$data[$x];        
            }            
        }
        return $strdate;
    }

	$equipamento = new TagEquipamento();		
		
	$equipamento->setNome($_POST['nome']);
	$equipamento->setDescricao($_POST['descricao']);
    $equipamento->setNumTombamento($_POST['num_tombamento']);    
    $equipamento->setDatabateria(formataDate($_POST['data_bateria']));
	$equipamento->setCodTag($_POST['codtag']);    
	
    $resultado = FachadaInformacao::getInstancia()->adicionarEquipamento($equipamento);

    echo $resultado;
?>