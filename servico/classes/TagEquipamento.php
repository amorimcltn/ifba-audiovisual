<?php

class TagEquipamento {
	
	public $idTagEquipamento;
	public $nome;
	public $descricao;
    public $numTombamento;
    public $dataBateria;
    public $statusLocacao;
    public $statusLocalizacao;
    public $codTag;
    public $ativo;
    	
	public function setIdTagEquipamento($idTagEquipamento){
		$this->idTagEquipamento = $idTagEquipamento;
	}
    
	public function setNome($nome){
		$this->nome = $nome;
	}
    
	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}
    
    public function setNumTombamento($numTombamento){
		$this->numTombamento = $numTombamento;
	}    
    
	public function setDataBateria($dataBateria){
		$this->dataBateria = $dataBateria;
	}

	public function setStatusLocacao($statusLocacao){
		$this->statusLocacao = $statusLocacao;
	}
    
	public function setStatusLocalizacao($statusLocalizacao){
		$this->statusLocalizacao = $statusLocalizacao;
	}
    
	public function setCodTag($codTag){
		$this->codTag = $codTag;
	}
    
	public function setAtivo($ativo){
		$this->ativo = $ativo;
	}      
	
	public function getIdTagEquipamento(){
		return $this->idTagEquipamento;
	}
    
	public function getNome(){
		return $this->nome;
	}
    
	public function getDescricao(){
		return $this->descricao;
	}
    
    public function getNumTombamento(){
		return $this->numTombamento;
	}        
    
	public function getDataBateria(){
		return $this->dataBateria;
	}

	public function getStatusLocacao(){
		return $this->statusLocacao;
	}
    
	public function getStatusLocalizacao(){
		return $this->statusLocalizacao;
	}      
    
	public function getCodTag(){
		return $this->codTag;
	}
    
	public function getAtivo(){
		return $this->ativo;
	}  
	
}

?>