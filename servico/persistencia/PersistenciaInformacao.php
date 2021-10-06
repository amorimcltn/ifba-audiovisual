<?php
require_once(dirname(__FILE__).'/../../config.php');
require_once(FACHADAS.'FachadaConectorBD.php');
require_once(CLASSES.'InstanciaUnica.php');
require_once(CLASSES.'Usuario.php');
require_once(CLASSES.'Tags.php');
require_once(CLASSES.'Localizador.php');
require_once(CLASSES.'LocacaoEquipamento.php');
require_once(CLASSES.'LogTag.php');
date_default_timezone_set('America/Sao_Paulo');

class PersistenciaInformacao extends InstanciaUnica{
    
	public function autenticarUser($login, $senha){
		$usuarios = NULL;
		$sql = "select a.cod_usuario, a.nome, a.tipo from usuario a where a.email = '".$login."' AND a.senha = '".$senha."'";         
		$registros = FachadaConectorBD::getInstancia()->consultar($sql);
		$i = 0;
		if (!is_null($registros)){
			foreach ($registros as $registro){
				$usuarios[$i] = new Usuario();
				$usuarios[$i]->setIdUsuario($registro["cod_usuario"]);
				$usuarios[$i]->setNomeUsuario($registro["nome"]);
				$usuarios[$i]->setTipoUsuario($registro["tipo"]);
				$i++;
			}
		}
		return $usuarios;
	}

    
	public function gravarTempTags($listatags){
        $listTemptags = explode(',', $listatags);
        $sql = "delete from tag where 1=1";
        FachadaConectorBD::getInstancia()->deletar($sql);
        for ($x = 0; $x < count($listTemptags); $x++){ 
            $sql = "select * from tag where cod_tag = '".$listTemptags[$x]."'";
            $registros = FachadaConectorBD::getInstancia()->consultar($sql);
            
            if (is_null($registros)){
                $sql = "select cod_localizador from tag_equipamento where cod_localizador = '".$listTemptags[$x]."'";
                $registros = FachadaConectorBD::getInstancia()->consultar($sql);
                if (is_null($registros)){
                    $sql = "INSERT INTO tag (cod_tag, registrada) VALUES ('".$listTemptags[$x]."',0)";    
                }                
                FachadaConectorBD::getInstancia()->inserir($sql);
            }
        }
		return 1;
	}
         
    
	public function insertLogInTags($idlocalizador, $listatags){
        $listTemptags = explode(',', $listatags); 
        for ($x = 0; $x < count($listTemptags); $x++){                 
            $sql = "select tag_equipamento.cod_tag_equipamento, locacao.cod_usuario from tag_equipamento
                    join locacao on (locacao.cod_tag = tag_equipamento.cod_tag_equipamento)
                    where tag_equipamento.cod_localizador = '".$listTemptags[$x]."'";            
            $registros = FachadaConectorBD::getInstancia()->consultar($sql);
              
            if (!is_null($registros)){
                foreach ($registros as $registro){
                    $sql = "select * from log_tag where cod_tag = ".$registro["cod_tag_equipamento"]." order by cod_log_tag DESC LIMIT 1";
                    $valida_registro = FachadaConectorBD::getInstancia()->consultar($sql);
                    if (!is_null($valida_registro)) {
                        if ($valida_registro[0]["tipo_evento"] == "SAIDA") {
                            $sql = "insert log_tag (data_evento, tipo_evento, cod_usuario, cod_tag, cod_localizador) 
                            VALUES ('".date('Y-m-d H:i')."','ENTRADA',".$registro["cod_usuario"].",".$registro["cod_tag_equipamento"].",
                            ".$idlocalizador.")";
                            FachadaConectorBD::getInstancia()->inserir($sql);
                        }
                    }
                }
            }           
        }       
		return 1;
	}
    
    
	public function insertLogOutTags($idlocalizador, $listatags){
        $listTemptags = explode(',', $listatags); 
        for ($x = 0; $x < count($listTemptags); $x++){ 
            $sql = "select tag_equipamento.cod_tag_equipamento, locacao.cod_usuario from tag_equipamento
                    join locacao on (locacao.cod_tag = tag_equipamento.cod_tag_equipamento)
                    where tag_equipamento.cod_localizador = '".$listTemptags[$x]."'";
            $registros = FachadaConectorBD::getInstancia()->consultar($sql);
            
            if (!is_null($registros)){
                foreach ($registros as $registro){
                    $sql = "INSERT INTO log_tag (data_evento, tipo_evento, cod_usuario, cod_tag, cod_localizador) 
                        VALUES ('".date('Y-m-d H:i')."','SAIDA',".$registro["cod_usuario"].",".$registro["cod_tag_equipamento"].",".$idlocalizador.")";
                    FachadaConectorBD::getInstancia()->inserir($sql);
                }
            }           
        }       
		return 1;
	}    
        
    
	public function deleteTempTags(){
        $sql = "delete from tag where 1=1";
        return FachadaConectorBD::getInstancia()->deletar($sql);
	}    
        
    
	public function selectTags(){
        $tags = NULL;
		$sql = 'select * from tag where 1=1';
		$registros = FachadaConectorBD::getInstancia()->consultar($sql);
		$i = 0;
		if (!is_null($registros)){
			foreach ($registros as $registro){
                $tags[$i] = new Tags();
				$tags[$i]->setCodTag($registro["cod_tag"]);
                $tags[$i]->setRegistrada($registro["registrada"]);
				$i++;
			}
		}
		return $tags;
	}
	
	public function inserirUsuario($usuario){         
		$sql = "select cod_usuario from usuario where email = '".$usuario->getEmailUsuario()."'";
		$registro = FachadaConectorBD::getInstancia()->consultar($sql);		
        if (is_null($registro)){
            $sql = "INSERT INTO usuario
                          (nome, tipo, email, senha)
                          VALUES
                          ('".$usuario->getNomeUsuario()."','".$usuario->getTipoUsuario()."','"
                .$usuario->getEmailUsuario()."','".$usuario->getSenhaUsuario()."')";
            return FachadaConectorBD::getInstancia()->inserir($sql);
		} else {
            return 0;
        }
		
	}
    
	public function inserirLocalizador($localizador){         				
        $sql = "INSERT INTO localizador
                      (nome_local, descricao, setor_local, ativo)
                      VALUES
                      ('".$localizador->getNomeLocal()."','".$localizador->getDescricao()."','"
            .$localizador->getSetorLocal()."',1)";        
        return FachadaConectorBD::getInstancia()->inserir($sql);		
		
	}
    
	public function updateReservaDevolucao($idusuario, $codtag){         				
        $sql = "select cod_tag from locacao where cod_tag = ".$codtag;
		$registro = FachadaConectorBD::getInstancia()->consultar($sql);		
        if (is_null($registro)){
            $sql = "INSERT INTO log_tag (data_evento, tipo_evento, cod_usuario, cod_tag, cod_localizador) 
                VALUES ('".date('Y-m-d H:i')."','RESERVA',".$idusuario.",".$codtag.",1)";                 
            FachadaConectorBD::getInstancia()->inserir($sql);            
            $sql = "INSERT INTO locacao (data_locacao, cod_usuario, cod_tag)
                VALUES('".date('Y-m-d H:i')."',".$idusuario.",".$codtag.")";
            return FachadaConectorBD::getInstancia()->inserir($sql);
        } else {
            $sql = "INSERT INTO log_tag (data_evento, tipo_evento, cod_usuario, cod_tag, cod_localizador) 
                VALUES ('".date('Y-m-d H:i')."','DEVOLUCAO',".$idusuario.",".$codtag.",1)";                  
            FachadaConectorBD::getInstancia()->inserir($sql);              
            $sql = "DELETE FROM locacao where cod_tag = ".$codtag;
            return FachadaConectorBD::getInstancia()->deletar($sql);
        }
	}
        
    
	public function adicionarEquipamento($equipamento){         
		$sql = "select cod_localizador from tag_equipamento where cod_localizador = '".$equipamento->getCodTag()."'";
		$registro = FachadaConectorBD::getInstancia()->consultar($sql);		
        if (is_null($registro)){
            $sql = "INSERT INTO tag_equipamento
                          (nome, descricao, num_tombamento, data_bateria, status_bem, status_localizacao, cod_localizador, ativo)
                          VALUES
                          ('".$equipamento->getNome()."','".$equipamento->getDescricao()."','".$equipamento->getNumTombamento()."','"
                .date_format(date_create($equipamento->getDataBateria()), 'Y-m-d')."',0,0,'".$equipamento->getCodTag()."',1)";                    
            $result = FachadaConectorBD::getInstancia()->inserir($sql);
            if ($result > 0) {
                $sql = "delete from tag where cod_tag = '".$equipamento->getCodTag()."'";
                FachadaConectorBD::getInstancia()->deletar($sql);                 
            }
            return $result;
		} else {
            return 0;
        }
		
	}    
	
    public function selectEquipamentosLocacao($filtro){
        $equipamentos = NULL;
        $sql = "select te.cod_tag_equipamento as codigo, te.nome as equipamento, usuario.cod_usuario, COALESCE(usuario.nome, '') resposanvel, COALESCE(locacao.data_locacao, '') data_locacao from tag_equipamento te
                left outer join locacao on te.cod_tag_equipamento = locacao.cod_tag
                left outer join usuario on locacao.cod_usuario = usuario.cod_usuario
                where";
        if ($filtro == 2) {
            $sql = $sql.' 1=1';    
        } else if ($filtro == 1) {
            $sql = $sql.' te.cod_tag_equipamento not in (select cod_tag from locacao)';        
        } else {
            $sql = $sql.' te.cod_tag_equipamento in (select cod_tag from locacao)';            
        }
        
        $registros = FachadaConectorBD::getInstancia()->consultar($sql);
        $i = 0;
        if (!is_null($registros)){
            foreach ($registros as $registro){
                $equipamentos[$i] = new LocacaoEquipamento();
                $equipamentos[$i]->setIdEquipamento($registro["codigo"]);
                $equipamentos[$i]->setNomeEquipamento($registro["equipamento"]);
                $equipamentos[$i]->setResponsavel($registro["resposanvel"]);
                $equipamentos[$i]->setIdResponsavel($registro["cod_usuario"]);
                if ($registro["data_locacao"] != null){
                    $equipamentos[$i]->setDataLocacao(date_format(date_create($registro["data_locacao"]), "d/m/Y H:i"));
                } else {
                    $equipamentos[$i]->setDataLocacao($registro["data_locacao"]);
                }
                
                $i++;
            }
        }
        return $equipamentos;
    }	

    public function selectRastreabilidade($idequipamento){
        $equipamentos = NULL;
        $sql = "select l.data_evento, l.tipo_evento, u.nome, loc.nome_local from log_tag l
            left outer join usuario u on (u.cod_usuario = l.cod_usuario)
            left outer join localizador loc on (loc.cod_localizador = l.cod_localizador)
            where l.cod_tag = ".$idequipamento;
        
		$registros = FachadaConectorBD::getInstancia()->consultar($sql);
		$i = 0;
		if (!is_null($registros)){
			foreach ($registros as $registro){
                $equipamentos[$i] = new LogTag();
                $equipamentos[$i]->setData_evento(date_format(date_create($registro["data_evento"]), "d/m/Y H:i"));
                $equipamentos[$i]->setTipo_evento($registro["tipo_evento"]);
                $equipamentos[$i]->setUsuario($registro["nome"]);
                $equipamentos[$i]->setLocalizador($registro["nome_local"]);
				$i++;
			}
		}
		return $equipamentos;
	}     
    
	public function selectLocalizadores($filtro){
        $localizadores = NULL;
        if ($filtro == 2) {
            $sql = 'select * from localizador where 1=1';    
        } else {
            $sql = 'select * from localizador where ativo = '.$filtro;        
        }
		
		$registros = FachadaConectorBD::getInstancia()->consultar($sql);
		$i = 0;
		if (!is_null($registros)){
			foreach ($registros as $registro){
                $localizadores[$i] = new Localizador();
				$localizadores[$i]->setCodLocalizador($registro["cod_localizador"]);
                $localizadores[$i]->setNomeLocal($registro["nome_local"]);
                $localizadores[$i]->setDescricao($registro["descricao"]);
                $localizadores[$i]->setSetorLocal($registro["setor_local"]);
                $localizadores[$i]->setAtivo($registro["ativo"]);
				$i++;
			}
		}
		return $localizadores;
	}    
    	
    
}


 

?>