<?php
include '/var/www/html/jodsonet/admin/classes/Ponte.php';
include '/var/www/html/jodsonet/admin/classes/Update.php';
include '/var/www/html/jodsonet/admin/classes/Read.php';

$up = new Update;

$data = date('Y/m/d');
$mes = date('n');

$dados = [
	'status' => 2
];

$up->ExeUpdate('clientes inner join carne on clientes.id = carne.cliente_id', $dados,
	'WHERE carne.status != :status_carne and carne.vencimento < :data and Month(carne.vencimento) = :mes',
	'status_carne=1&data=' . $data . '&mes=' . $mes);
if($up->getResult()):
	echo 'Operação realizada com sucesso!';
endif;