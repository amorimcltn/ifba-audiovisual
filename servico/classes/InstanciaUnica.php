<?php

Class InstanciaUnica
{
    
    public static function getInstancia()
    {
        static $instancia = null;
        
        if (!isset($instancia)) {
            $instancia = new static;
        }
        return $instancia;
    }

}

?>