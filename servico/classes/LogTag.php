<?php

class LogTag {
	
	public $data_evento;
    public $tipo_evento;
    public $usuario;
    public $localizador;
    	
	public function getData_evento(){
		return $this->data_evento;
	}

	public function setData_evento($data_evento){
		$this->data_evento = $data_evento;
	}

	public function getTipo_evento(){
		return $this->tipo_evento;
	}

	public function setTipo_evento($tipo_evento){
		$this->tipo_evento = $tipo_evento;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}

	public function getLocalizador(){
		return $this->localizador;
	}

	public function setLocalizador($localizador){
		$this->localizador = $localizador;
	}    

}

?>