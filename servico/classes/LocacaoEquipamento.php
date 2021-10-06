<?php

class LocacaoEquipamento {
	
	public $idEquipamento;
	public $nomeEquipamento;	    
    public $responsavelLocacao;
    public $idResponsavelLocacao;
    public $dataLocacao;
    	
	public function setIdEquipamento($idEquipamento){
		$this->idEquipamento = $idEquipamento;
	}
    
	public function setNomeEquipamento($nomeEquipamento){
		$this->nomeEquipamento = $nomeEquipamento;
	}
    
	public function setResponsavel($responsavelLocacao){
		$this->responsavelLocacao = $responsavelLocacao;
	}
    
	public function setIdResponsavel($idResponsavelLocacao){
		$this->idResponsavelLocacao = $idResponsavelLocacao;
	}    
    
    public function setDataLocacao($dataLocacao){
		$this->dataLocacao = $dataLocacao;
	}    
        
	
	public function getIdEquipamento(){
		return $this->idEquipamento;
	}
    
	public function getNomeEquipamento(){
		return $this->nomeEquipamento;
	}
    
	public function getResponsavel(){
		return $this->responsavelLocacao;
	}
    
	public function getIdResponsavel(){
		return $this->idResponsavelLocacao;
	}    
    
    public function getDataLocacao(){
		return $this->dataLocacao;
	}        

	
}

?>