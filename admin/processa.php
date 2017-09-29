<?php
include 'autoLoad.php';

$arq = file_get_contents("php://input");
$dados = json_decode($arq);

switch ($dados->funcao) {

	/***********************
	******* LOGIN ********
	***********************/

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

	/***********************
	****** CLIENTES ********
	***********************/

	case 'ler_clientes':
		$read = new Read;
		$campos = 'clientes.id, clientes.nome, clientes.apelido, clientes.celular, clientes.cpf, clientes.desconto, clientes.cidade, clientes.cep, clientes.rua, clientes.numero, clientes.bairro, clientes.created_at, planos.valor, planos.plano';
		$read->ExeRead('clientes inner join planos on clientes.plano = planos.id', null, null, $campos);
		print json_encode($read->getResult());
		break;

	case 'ler_cliente':
		$read = new Read;
		$campos = '';
		$read->ExeRead('clientes', 'WHERE id = :id', 'id=' . $dados->id);
		print json_encode($read->getResult()[0]);
		break;

	case 'cadastrar_cliente':
		unset($dados->funcao);
		$clientes = new Clientes($dados);
		$clientes->cadastrar();
		print json_encode($clientes->getResult());
		break;

	case 'alterar_cliente':
		unset($dados->funcao);
		$clientes = new Clientes($dados);
		$clientes->alterar();
		print json_encode($clientes->getResult());
		break;

	case 'deletar_cliente':
		$del = new Delete;
		$del->ExeDelete('clientes',  'WHERE id = :id', 'id=' . Helpers::limpeza($dados->id));
		print json_encode($del->getResult());
		break;

	case 'gerar':
		$carne = new Carne($dados);
		print json_encode($carne->getResult());	
		break;

	/***********************
	******** PLANOS ********
	***********************/

	case 'ler_planos':
		unset($dados->funcao);
		$planos = new Planos($dados);
		$planos->ler();
		print json_encode($planos->getResult());
		break;

	case 'del_planos':
		$del = new Delete;
		$del->ExeDelete('planos', 'WHERE id = :id', 'id=' . Helpers::limpeza($dados->id));
		print json_encode($del->getResult());
		break;

	case 'cadastrar_planos':
		unset($dados->funcao);
		$planos = new Planos($dados);
		$planos->cadastrar();
		print json_encode($planos->getResult());
		break;

}