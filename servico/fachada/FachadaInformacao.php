<?php
require_once(PERSISTENCIA.'PersistenciaInformacao.php');
require_once(CLASSES.'InstanciaUnica.php');

class FachadaInformacao extends InstanciaUnica{

	public function autenticarUsuario($login, $senha){
		$registros = PersistenciaInformacao::getInstancia()->autenticarUser($login, $senha);
		if($registros!=NULL){
			return $registros;
		} else { 
			return NULL;
		}
	}

	public function adicionarUsuario($usuario){
		return PersistenciaInformacao::getInstancia()->inserirUsuario($usuario);
	}
    
	public function listarTag(){
		return PersistenciaInformacao::getInstancia()->selectTags();
	}      
    
	public function gravarTempTags($listatags){
		return PersistenciaInformacao::getInstancia()->gravarTempTags($listatags);
	} 
    
	public function deletaTempTags(){
		return PersistenciaInformacao::getInstancia()->deleteTempTags();
	}     
    
	public function adicionarEquipamento($equipamento){
		return PersistenciaInformacao::getInstancia()->adicionarEquipamento($equipamento);
	}     
        
	public function adicionarLocalizador($localizador){
		return PersistenciaInformacao::getInstancia()->inserirLocalizador($localizador);
	}    
    
	public function listarEquipamentosLocacao($filtro){
		return PersistenciaInformacao::getInstancia()->selectEquipamentosLocacao($filtro);
	}     
    
	public function listarLocalizadores($filtro){
		return PersistenciaInformacao::getInstancia()->selectLocalizadores($filtro);
	}    
    
	public function gerenciaReservaDevolucao($idusuario, $codtag){
		return PersistenciaInformacao::getInstancia()->updateReservaDevolucao($idusuario, $codtag);
	}    
      
	public function gravarLogInTags($idlocalizador, $listatags){
		return PersistenciaInformacao::getInstancia()->insertLogInTags($idlocalizador, $listatags);
	}
    
	public function gravarLogOutTags($idlocalizador, $listatags){
		return PersistenciaInformacao::getInstancia()->insertLogOutTags($idlocalizador, $listatags);
	}	

	public function buscaRastreabilidade($idequipamento){
		return PersistenciaInformacao::getInstancia()->selectRastreabilidade($idequipamento);
	}     
    	
}

?>