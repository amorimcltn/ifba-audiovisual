<?php

class Usuario {
	
	public $idusuario;
	public $nome;
	public $tipo;
    public $email;
    public $senha;
    	
	public function setIdUsuario($idusuario){
		$this->idusuario = $idusuario;
	}
	
	public function setNomeUsuario($nome){
		$this->nome = $nome;
	}
	
	public function setTipoUsuario($tipo){
		$this->tipo = $tipo;
	}
    
	public function setEmailUsuario($email){
		$this->email = $email;
	}
    
	public function setSenhaUsuario($senha){
		$this->senha = $senha;
	}    
	
	public function getIdUsuario(){
		return $this->idusuario;
	}
	
	public function getNomeUsuario(){
		return $this->nome;
	}
	
	public function getTipoUsuario(){
		return $this->tipo;
	}
    
	public function getEmailUsuario(){
		return $this->email;
	}
    
	public function getSenhaUsuario(){
		return $this->senha;
	}    

}

?>