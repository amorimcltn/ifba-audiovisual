<?php
require_once (dirname(__FILE__).'../../config.php');
require_once(FACHADAS.'FachadaInformacao.php');
require_once(CLASSES.'Usuario.php');
require_once(CLASSES.'Tags.php');
require_once (SLIM. 'Slim.php');

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

    $app->get('/login/:login/:senha', function ($login, $senha) {
        $nativo = FachadaInformacao::getInstancia()->autenticarUsuario($login, $senha);
        // cria array de objetos para json
        $usuarios = array();
        foreach ($nativo as $usuario) {
            $std = new Usuario();
            $std->idusuario = $usuario->getIdUsuario();
            $std->nome = $usuario->getNomeUsuario();
            $std->cpf = $usuario->getTipoUsuario();
            $usuarios[] = $std;
        }
        echo json_encode($usuarios[0]);
    });


   $app->get('/gravatags/:listatags', function ($listatags) {
        $result = FachadaInformacao::getInstancia()->gravarTempTags($listatags);
        echo $result;
    });


   $app->get('/deletatags', function () {
        $result = FachadaInformacao::getInstancia()->deletaTempTags();
        echo $result;
    });


   $app->get('/registralogin/:idlocalizador/:listatags', function ($idlocalizador, $listatags) {
        $result = FachadaInformacao::getInstancia()->gravarLogInTags($idlocalizador, $listatags);
        echo $result;
    });


   $app->get('/registralogout/:idlocalizador/:listatags', function ($idlocalizador, $listatags) {
        $result = FachadaInformacao::getInstancia()->gravarLogOutTags($idlocalizador, $listatags);
        echo $result;
    });
	

	$app->get('/listalembretes', function () {
		$nativo = FachadaInformacao::getInstancia()->listaLembretes();
		// cria array de objetos para json
		$lembretes = NULL;
		if ($nativo != NULL){
			foreach ($nativo as $lembrete) {
				$std = new Lembrete();
				$std->idlembrete = $lembrete->getIdLembrete();
				$std->assunto = $lembrete->getAssunto();
				$std->conteudo = $lembrete->getConteudo();
				$std->importancia = $lembrete->getImportancia();				
				$lembretes[] = $std;
			}
			echo json_encode($lembretes);
		}
		
		
		
	});	

$app->run();