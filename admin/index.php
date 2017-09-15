<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="pt-br" ng-app="app">
<head>
	<meta charset="utf-8"/>
	<meta name="robots" content="noindex, nofollow" />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="icon" href="../imagens/icon.png">	
	<title>Gerar Boletos</title>
	<link rel="stylesheet" href="../css/animate.css">
	<link rel="stylesheet" href="../css/boleto.css">
	<base href="/jodsonet/admin/" />
</head>
<body class="corpo" ng-controller="singleCtrl as ctrl">
<div ng-click="ctrl.jan_planos()" id="tela"></div>
<form id="jan_planos" ng-submit="ctrl.cadastrar(ctrl.planos)">
	<fieldset>
		<legend>Cadastro de planos</legend>
		<input type="text" title="Nome plano" placeholder="Nome do novo plano" required ng-model="ctrl.planos.nome" />
		<input type="number" title="Valor do plano" placeholder="Valor do plano" required ng-model="ctrl.planos.valor" />
		<input type="submit" class="send" value="Cadastrar" />
		<span id="mensagem_cadastro_planos" class="animated fadeIn">Informações salvas com sucesso!</span>
	</fieldset>
</form>
<img src="../imagens/logo.png" class="logo animated fadeInLeftBig">
<nav class="animated fadeInLeftBig">
	<a href="cadastrar-cliente" title="Cadastrar novo cliente"><img src="../imagens/user.png" class="icon" /></a>
	<a href="listar-cliente" title="listar clientes"><img src="../imagens/list-cliente.png" class="icon" /></a>
	<a href ng-click="ctrl.jan_planos()" title="Cadastrar um novo plano"><img src="../imagens/planos.png" class="icon" /></a>
	<a href ng-click="ctrl.logout()" title="Sair"><img src="../imagens/exit.png" class="icon" /></a>
</nav>
<ng-view></ng-view>
<script src="../js/lib/jquery-1.11.3.min.js"></script>
<script src="../js/lib/angular.min.js"></script>
<script src="../js/lib/mask.js"></script>
<script src="../js/lib/angular-route.min.js"></script>
<script src="../js/lib/ngprogress.js"></script>
<script src="../js/module.js"></script>
<script src="../js/rotas.js"></script>
<script src="../js/factory.js"></script>
<script src="../js/singleCtrl.js"></script>
<script src="../js/cadClienteCtrl.js"></script>
<script src="../js/listClienteCtrl.js"></script>
</body>
</html>