<?php

class Localizador {      
	
	public $cod_localizador;
	public $nome_local;
	public $descricao;
    public $setor_local;
    public $ativo;
    	
	public function setCodLocalizador($cod_localizador){
		$this->cod_localizador = $cod_localizador;
	}
	
	public function setNomeLocal($nome_local){
		$this->nome_local = $nome_local;
	}
	
	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}
    
	public function setSetorLocal($setor_local){
		$this->setor_local = $setor_local;
	}
    
	public function setAtivo($ativo){
		$this->ativo = $ativo;
	}    
	
	public function getCodLocalizador(){
		return $this->cod_localizador;
	}
	
	public function getNomeLocal(){
		return $this->nome_local;
	}
	
	public function getDescricao(){
		return $this->descricao;
	}
    
	public function getSetorLocal(){
		return $this->setor_local;
	}
    
	public function getAtivo(){
		return $this->ativo;
	} 
    

}

?>