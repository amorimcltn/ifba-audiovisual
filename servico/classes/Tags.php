<?php

class Tags {
	
	public $codTag;
    public $registrada;
    	
	public function setCodTag($codTag){
		$this->codTag = $codTag;
	}
    
	public function setRegistrada($registrada){
		$this->registrada = $registrada;
	}    
    
	public function getCodTag(){
		return $this->codTag;
	}
    
	public function getRegistrada(){
		return $this->registrada;
	}     

}

?>