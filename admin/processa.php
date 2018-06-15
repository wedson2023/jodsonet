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
		if($read->getRowCount()):
			foreach($read->getResult() as $dados):
				$read->ExeRead('carne', 'WHERE cliente_id = :cliente_id ORDER BY numero DESC', 'cliente_id=' . $dados->id );
				if($read->getRowCount()):
					$dados->carne = $read->getResult();
				endif;
				$clientes[] = $dados;
			endforeach;
			print json_encode($clientes);
		endif;
		
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
		$del->ExeDelete('carne',  'WHERE cliente_id = :cliente_id', 'cliente_id=' . Helpers::limpeza($dados->id));
		print json_encode($del->getResult());
		break;

	/***********************
	******** CARNE ********
	***********************/

	case 'listar_por_data':

		$read = new Read;
		$campos = 'carne.id, clientes.nome, carne.numero, carne.vencimento, carne.status';

		if(isset($dados->status) and !is_null($dados->status)):
			$read->ExeRead('carne inner join clientes on carne.cliente_id = clientes.id', 'WHERE carne.vencimento BETWEEN "' . $dados->inicio . '" and "' . $dados->fim . '" AND status = :status ORDER BY status DESC, carne.numero DESC', 'status=' . $dados->status, $campos);			
		else:
			$read->ExeRead('carne inner join clientes on carne.cliente_id = clientes.id', 'WHERE carne.vencimento BETWEEN "' . $dados->inicio . '" and "' . $dados->fim . '" ORDER BY status DESC, carne.numero DESC', null, $campos);
		endif;
		
		print json_encode($read->getResult());	
		break;

	case 'ler_carne':
		$read = new Read;
		$campos = 'carne.id, clientes.nome, carne.numero, carne.vencimento, carne.status';
		$read->ExeRead('carne inner join clientes on carne.cliente_id = clientes.id', 'WHERE status != :status ORDER BY status DESC, carne.numero DESC', 'status=0', $campos);
		print json_encode($read->getResult());	
		break;

	case 'gerar':
		$carne = new Carne($dados);
		$carne->validacao();
		print json_encode($carne->getResult());	
		break;

	case 'segunda_via':
		$carne = new Carne($dados);
		$carne->segunda_via();
		print json_encode($carne->getResult());	
		break;

	case 'del_boleto':
		$del = new Delete;
		$del->ExeDelete('carne', 'WHERE id = :id', 'id=' . $dados->id);
		print json_encode($del->getResult());	
		break;

	case 'dar_baixa':
		$status = (int) $dados->status == 0 ? 1 : ( (int) $dados->status == 2 ? 1 : ( (int) $dados->status == 1 ? 2 : 0 ));

		$up = new Update;
		$up->ExeUpdate('carne', [ 'status' => $status ], 'WHERE id = :id', 'id=' . $dados->id);
		print json_encode($up->getResult());	
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
