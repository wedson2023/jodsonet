<?php
include 'autoLoad.php';

$arq = file_get_contents("php://input");
$dados = json_decode($arq);

switch ($dados->funcao) {
	case 'logar':
		$login = new Login($dados);
		print json_encode($login->getResult());
		break;

	case 'sair':
		session_start();
		if(session_destroy()):
			print json_encode(true);
		endif;
		break;

	case 'cadastrar_cliente':
		unset($dados->funcao);
		$clientes = new Clientes($dados);
		$clientes->cadastrar();
		print json_encode($clientes->getResult());
		break;

	case 'cadastrar_planos':
		unset($dados->funcao);
		$planos = new Planos($dados);
		$planos->cadastrar();
		print json_encode($planos->getResult());
		break;

	case 'ler_planos':
		unset($dados->funcao);
		$planos = new Planos($dados);
		$planos->ler();
		print json_encode($planos->getResult());
		break;
}